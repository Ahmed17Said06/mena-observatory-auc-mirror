#!/usr/bin/env bash
#
# Provision a bare Ubuntu 26.04 host to match the production observatory stack.
#
# Installs the same versions production runs, so there is nothing to reconcile
# after cutover:
#   nginx 1.28.3   php 8.5.4 (+fpm)   mysql 8.4.11   composer 2.x   certbot 4.x
#
# Idempotent: safe to re-run. It does not touch the database contents, the
# application .env, or storage/ -- those are moved in phase 2 of the cutover
# runbook.
#
# Usage (on the new host):
#   sudo bash scripts/provision-server.sh
#
set -euo pipefail

APP_DIR=/var/www/observatory
REPO=https://github.com/Ahmed17Said06/mena-observatory-auc-mirror.git
BRANCH=fixes
PHP=8.5

log() { printf '\n==> %s\n' "$*"; }

if [[ $EUID -ne 0 ]]; then
    echo "Run with sudo." >&2
    exit 1
fi

log "Checking we are on the expected distro"
. /etc/os-release
if [[ "${VERSION_ID:-}" != "26.04" ]]; then
    echo "WARNING: expected Ubuntu 26.04, found ${PRETTY_NAME:-unknown}." >&2
    echo "The pinned package versions below may not exist on this release." >&2
fi

log "Installing packages"
export DEBIAN_FRONTEND=noninteractive
apt-get update -qq
# Extension set mirrors production exactly (dpkg -l on the old host).
apt-get install -y -qq \
    nginx \
    mysql-server \
    php${PHP}-fpm php${PHP}-cli php${PHP}-common \
    php${PHP}-bcmath php${PHP}-curl php${PHP}-gd php${PHP}-igbinary \
    php${PHP}-mbstring php${PHP}-mysql php${PHP}-readline php${PHP}-redis \
    php${PHP}-xml php${PHP}-zip \
    certbot python3-certbot-nginx \
    git unzip rsync curl

log "Installing composer"
if ! command -v composer >/dev/null; then
    curl -sS https://getcomposer.org/installer -o /tmp/composer-setup.php
    php /tmp/composer-setup.php --install-dir=/usr/local/bin --filename=composer --quiet
    rm -f /tmp/composer-setup.php
fi
composer --version

log "Matching production php.ini (fpm)"
# Production values, read off the old host. Laravel's own limits are lower than
# these in places, but keep the platform identical so behaviour does not shift.
INI=/etc/php/${PHP}/fpm/php.ini
set_ini() {
    local key=$1 val=$2
    if grep -qE "^\s*;?\s*${key}\s*=" "$INI"; then
        sed -i -E "s|^\s*;?\s*${key}\s*=.*|${key} = ${val}|" "$INI"
    else
        printf '%s = %s\n' "$key" "$val" >> "$INI"
    fi
}
set_ini max_execution_time 30
set_ini memory_limit 128M
set_ini post_max_size 8M
set_ini upload_max_filesize 2M

log "Preparing $APP_DIR"
mkdir -p "$APP_DIR"
if [[ ! -d "$APP_DIR/.git" ]]; then
    git clone --branch "$BRANCH" "$REPO" "$APP_DIR"
else
    git -C "$APP_DIR" fetch origin "$BRANCH"
    git -C "$APP_DIR" checkout "$BRANCH"
    git -C "$APP_DIR" pull origin "$BRANCH"
fi
chown -R www-data:www-data "$APP_DIR"

log "Installing nginx site (HTTP only -- TLS is added at cutover)"
# Deliberately no ssl_* directives here. The certificate is copied from the old
# host during cutover, and certbot rewrites this file afterwards.
cat > /etc/nginx/sites-available/observatory <<NGINX
server {
    listen 80;
    listen [::]:80;
    server_name menaobservatory.ai www.menaobservatory.ai;
    root $APP_DIR/public;

    index index.php;
    charset utf-8;

    # Production nginx omits this, so uploads are capped at nginx's 1M default
    # even though PHP allows 2M. Set it explicitly to the PHP limit.
    client_max_body_size 2M;

    location / {
        try_files \$uri \$uri/ /index.php?\$query_string;
    }

    location ~ \.php\$ {
        fastcgi_pass unix:/run/php/php${PHP}-fpm.sock;
        fastcgi_param SCRIPT_FILENAME \$realpath_root\$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
NGINX
ln -sfn /etc/nginx/sites-available/observatory /etc/nginx/sites-enabled/observatory
rm -f /etc/nginx/sites-enabled/default

log "Enabling services"
systemctl enable --now mysql nginx "php${PHP}-fpm"
nginx -t
systemctl reload nginx

log "Done. Versions installed:"
printf '  nginx    %s\n' "$(nginx -v 2>&1 | sed 's|.*/||')"
printf '  php      %s\n' "$(php -r 'echo PHP_VERSION;')"
printf '  mysql    %s\n' "$(mysql --version | sed -E 's/.*Ver ([0-9.]+).*/\1/')"
printf '  composer %s\n' "$(composer --version --no-ansi | awk '{print $3}')"

cat <<'NEXT'

Next: move the data (database, .env, storage/app/public) -- phase 2 of the
cutover runbook.
NEXT
