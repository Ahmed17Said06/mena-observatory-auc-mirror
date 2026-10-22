#!/usr/bin/env bash
#
# Proves the new database is a complete copy of the old one, table by table.
# Read-only on both sides. Run it on the old server once replication is up,
# and again immediately after promoting the replica:
#
#     sudo bash scripts/db-compare.sh --new-host 1.2.3.4
#     sudo bash scripts/db-compare.sh --new-host 1.2.3.4 --new-user repl_check
#
# Old-side credentials come from the project's .env. New-side credentials
# default to the same values, since an AMI clone starts with the same grants.
#
# Exit status is 0 only when every table exists on both sides with the same
# row count, so it can gate a cutover script.

set -euo pipefail

PROJECT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
ENV_FILE="$PROJECT_DIR/.env"

NEW_HOST=""; NEW_PORT=""; NEW_USER=""; NEW_PASS=""; NEW_DB=""
VERBOSE=0

while [ $# -gt 0 ]; do
    case "$1" in
        --new-host) NEW_HOST="$2"; shift 2 ;;
        --new-port) NEW_PORT="$2"; shift 2 ;;
        --new-user) NEW_USER="$2"; shift 2 ;;
        --new-pass) NEW_PASS="$2"; shift 2 ;;
        --new-db)   NEW_DB="$2";   shift 2 ;;
        --verbose|-v) VERBOSE=1; shift ;;
        -h|--help) sed -n '2,15p' "${BASH_SOURCE[0]}"; exit 0 ;;
        *) echo "Unknown option: $1" >&2; exit 2 ;;
    esac
done

[ -n "$NEW_HOST" ] || { echo "--new-host is required" >&2; exit 2; }
[ -f "$ENV_FILE" ] || { echo "No .env at $ENV_FILE" >&2; exit 1; }
command -v mysql >/dev/null || { echo "mysql client not found" >&2; exit 1; }

env_get() {
    sed -nE "s/^[[:space:]]*$1[[:space:]]*=[[:space:]]*(.*)$/\1/p" "$ENV_FILE" \
        | head -n1 \
        | sed -E 's/[[:space:]]+#.*$//; s/^"(.*)"$/\1/; s/^'"'"'(.*)'"'"'$/\1/' \
        | tr -d '\r'
}

OLD_HOST="$(env_get DB_HOST)"; OLD_HOST="${OLD_HOST:-127.0.0.1}"
OLD_PORT="$(env_get DB_PORT)"; OLD_PORT="${OLD_PORT:-3306}"
OLD_DB="$(env_get DB_DATABASE)"
OLD_USER="$(env_get DB_USERNAME)"
OLD_PASS="$(env_get DB_PASSWORD)"

# 'mysql' is a docker-compose service name; on this host it will not resolve.
if [ "$OLD_HOST" = "mysql" ] && ! getent hosts mysql >/dev/null 2>&1; then
    OLD_HOST=127.0.0.1
fi

NEW_PORT="${NEW_PORT:-$OLD_PORT}"
NEW_USER="${NEW_USER:-$OLD_USER}"
NEW_PASS="${NEW_PASS:-$OLD_PASS}"
NEW_DB="${NEW_DB:-$OLD_DB}"

# Keep both passwords out of argv.
OLD_CNF="$(mktemp)"; NEW_CNF="$(mktemp)"
chmod 600 "$OLD_CNF" "$NEW_CNF"
cleanup() { rm -f "$OLD_CNF" "$NEW_CNF"; }
trap cleanup EXIT
printf '[client]\nuser=%s\npassword=%s\nhost=%s\nport=%s\n' \
    "$OLD_USER" "$OLD_PASS" "$OLD_HOST" "$OLD_PORT" > "$OLD_CNF"
printf '[client]\nuser=%s\npassword=%s\nhost=%s\nport=%s\n' \
    "$NEW_USER" "$NEW_PASS" "$NEW_HOST" "$NEW_PORT" > "$NEW_CNF"

q_old() { mysql --defaults-extra-file="$OLD_CNF" -N -B -e "$1" "$OLD_DB"; }
q_new() { mysql --defaults-extra-file="$NEW_CNF" -N -B -e "$1" "$NEW_DB"; }

echo "OLD  $OLD_USER@$OLD_HOST:$OLD_PORT/$OLD_DB"
echo "NEW  $NEW_USER@$NEW_HOST:$NEW_PORT/$NEW_DB"
echo

q_old "SELECT 1" >/dev/null || { echo "Cannot reach the OLD database" >&2; exit 1; }
q_new "SELECT 1" >/dev/null || { echo "Cannot reach the NEW database (check the security group allows 3306 from this host)" >&2; exit 1; }

# Base tables only — views have no rows of their own.
LIST_SQL="SELECT table_name FROM information_schema.tables
          WHERE table_schema = DATABASE() AND table_type = 'BASE TABLE'
          ORDER BY table_name"

OLD_TABLES="$(q_old "$LIST_SQL")"
NEW_TABLES="$(q_new "$LIST_SQL")"

MISSING="$(comm -23 <(echo "$OLD_TABLES") <(echo "$NEW_TABLES") || true)"
EXTRA="$(comm -13 <(echo "$OLD_TABLES") <(echo "$NEW_TABLES") || true)"

FAIL=0
if [ -n "$MISSING" ]; then
    echo "MISSING on the new server:"
    echo "$MISSING" | sed 's/^/  - /'
    FAIL=1
fi
if [ -n "$EXTRA" ]; then
    echo "Only on the new server (usually harmless):"
    echo "$EXTRA" | sed 's/^/  + /'
fi
[ -n "$MISSING$EXTRA" ] && echo

# COUNT(*) per table, not the information_schema estimate, which is wrong for
# InnoDB and would happily report a match over missing rows.
printf '%-34s %12s %12s   %s\n' "TABLE" "OLD" "NEW" ""
printf '%-34s %12s %12s   %s\n' "-----" "---" "---" ""

TOTAL_OLD=0; TOTAL_NEW=0; MISMATCH=0; CHECKED=0
while IFS= read -r t; do
    [ -n "$t" ] || continue
    echo "$NEW_TABLES" | grep -qx "$t" || continue

    o="$(q_old "SELECT COUNT(*) FROM \`$t\`")"
    n="$(q_new "SELECT COUNT(*) FROM \`$t\`")"
    CHECKED=$((CHECKED + 1))
    TOTAL_OLD=$((TOTAL_OLD + o)); TOTAL_NEW=$((TOTAL_NEW + n))

    if [ "$o" = "$n" ]; then
        [ "$VERBOSE" = "1" ] && printf '%-34s %12s %12s   ok\n' "$t" "$o" "$n"
    else
        printf '%-34s %12s %12s   DIFF (%+d)\n' "$t" "$o" "$n" "$((n - o))"
        MISMATCH=$((MISMATCH + 1)); FAIL=1
    fi
done <<< "$OLD_TABLES"

echo
printf 'Tables compared: %d   rows old: %d   rows new: %d\n' "$CHECKED" "$TOTAL_OLD" "$TOTAL_NEW"

if [ "$MISMATCH" = "0" ] && [ -z "$MISSING" ]; then
    echo "RESULT: every table matches."
else
    echo "RESULT: $MISMATCH table(s) differ."
    echo "If replication is still running, a small lag on write-heavy tables is"
    echo "expected — re-run after 'SHOW REPLICA STATUS' reports Seconds_Behind_Source = 0."
fi

exit $FAIL
