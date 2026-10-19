#!/usr/bin/env bash
#
# Takes a verified, timestamped backup of the production database (and, with
# --with-files, the uploaded files that live on the instance disk). Intended to
# be run on the server from the project root, before a migration or any risky
# change:
#
#     sudo bash scripts/backup-db.sh                 # database only
#     sudo bash scripts/backup-db.sh --with-files    # database + storage/app/public
#     sudo bash scripts/backup-db.sh --out /mnt/bak  # write somewhere else
#
# Credentials are read from the project's .env, so there is nothing to type and
# no password ends up in your shell history or the process list.

set -euo pipefail

PROJECT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
OUT_DIR="$PROJECT_DIR/backups"
WITH_FILES=0

while [ $# -gt 0 ]; do
    case "$1" in
        --with-files) WITH_FILES=1; shift ;;
        --out) OUT_DIR="$2"; shift 2 ;;
        -h|--help) sed -n '2,14p' "${BASH_SOURCE[0]}"; exit 0 ;;
        *) echo "Unknown option: $1" >&2; exit 2 ;;
    esac
done

ENV_FILE="$PROJECT_DIR/.env"
[ -f "$ENV_FILE" ] || { echo "No .env at $ENV_FILE" >&2; exit 1; }

# Pull one value out of .env, tolerating quotes and inline comments.
env_get() {
    sed -nE "s/^[[:space:]]*$1[[:space:]]*=[[:space:]]*(.*)$/\1/p" "$ENV_FILE" \
        | head -n1 \
        | sed -E 's/[[:space:]]+#.*$//; s/^"(.*)"$/\1/; s/^'"'"'(.*)'"'"'$/\1/' \
        | tr -d '\r'
}

DB_HOST="$(env_get DB_HOST)";     DB_HOST="${DB_HOST:-127.0.0.1}"
DB_PORT="$(env_get DB_PORT)";     DB_PORT="${DB_PORT:-3306}"
DB_NAME="$(env_get DB_DATABASE)"
DB_USER="$(env_get DB_USERNAME)"
DB_PASS="$(env_get DB_PASSWORD)"

[ -n "$DB_NAME" ] || { echo "DB_DATABASE is empty in .env" >&2; exit 1; }

# 'mysql' / 'redis' are docker-compose service names; on a non-Docker host they
# will not resolve, so fall back to the local socket.
if [ "$DB_HOST" = "mysql" ] && ! getent hosts mysql >/dev/null 2>&1; then
    echo "note: DB_HOST=mysql does not resolve here; using 127.0.0.1"
    DB_HOST=127.0.0.1
fi

command -v mysqldump >/dev/null || { echo "mysqldump not found" >&2; exit 1; }

mkdir -p "$OUT_DIR"
STAMP="$(date +%Y%m%d_%H%M%S)"
DUMP="$OUT_DIR/db_${DB_NAME}_${STAMP}.sql.gz"

# Keep the password out of argv by handing it to mysqldump via a temp defaults
# file that only this user can read.
CNF="$(mktemp)"
chmod 600 "$CNF"
trap 'rm -f "$CNF"' EXIT
printf '[client]\nuser=%s\npassword=%s\nhost=%s\nport=%s\n' \
    "$DB_USER" "$DB_PASS" "$DB_HOST" "$DB_PORT" > "$CNF"

echo "Dumping database '$DB_NAME' from $DB_HOST:$DB_PORT ..."
# --single-transaction keeps InnoDB consistent without locking the live site;
# --no-tablespaces avoids needing the PROCESS privilege the app user lacks.
mysqldump --defaults-extra-file="$CNF" \
    --single-transaction \
    --no-tablespaces \
    --quick \
    --routines --triggers --events \
    --default-character-set=utf8mb4 \
    --databases "$DB_NAME" \
    | gzip -9 > "$DUMP"

# A truncated dump is the classic silent failure, so verify before trusting it.
if ! gzip -t "$DUMP" 2>/dev/null; then
    echo "FAILED: $DUMP is not a valid gzip archive" >&2
    exit 1
fi
if ! zcat "$DUMP" | tail -5 | grep -q "Dump completed"; then
    echo "FAILED: $DUMP has no 'Dump completed' marker — it is truncated" >&2
    exit 1
fi

TABLES="$(zcat "$DUMP" | grep -c '^CREATE TABLE' || true)"
sha256sum "$DUMP" > "$DUMP.sha256"

echo "OK  $DUMP"
echo "    $(du -h "$DUMP" | cut -f1), $TABLES tables"
echo "    sha256 recorded in $(basename "$DUMP").sha256"

if [ "$WITH_FILES" = "1" ]; then
    FILES_DIR="$PROJECT_DIR/storage/app/public"
    ARCHIVE="$OUT_DIR/storage_${STAMP}.tar.gz"
    echo
    echo "Archiving uploaded files from $FILES_DIR ..."
    tar -czf "$ARCHIVE" -C "$PROJECT_DIR/storage/app" public
    tar -tzf "$ARCHIVE" >/dev/null || { echo "FAILED: $ARCHIVE is unreadable" >&2; exit 1; }
    sha256sum "$ARCHIVE" > "$ARCHIVE.sha256"
    echo "OK  $ARCHIVE"
    echo "    $(du -h "$ARCHIVE" | cut -f1), $(tar -tzf "$ARCHIVE" | wc -l) entries"
fi

echo
echo "Copy these off the instance before migrating, e.g.:"
echo "  scp ubuntu@<server>:$OUT_DIR/* ./"
