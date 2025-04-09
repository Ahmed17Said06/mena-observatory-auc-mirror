#!/bin/bash

echo "Setting up storage directory..."

# Create required directories
mkdir -p /var/www/html/storage/framework/sessions
mkdir -p /var/www/html/storage/framework/views
mkdir -p /var/www/html/storage/framework/cache
mkdir -p /var/www/html/storage/app/public

# If the host has images, copy them to the storage volume directly
if [ -d "/var/www/html/host-storage" ] && [ "$(ls -A /var/www/html/host-storage)" ]; then
    echo "Copying images from host directory to storage volume..."
    cp -rf /var/www/html/host-storage/* /var/www/html/storage/app/public/
fi

# SKIP the ownership change that's failing
# chown -R www-data:www-data /var/www/html/storage

# Create correct symbolic link structure
rm -f /var/www/html/public/storage
ln -sf /var/www/html/storage/app/public /var/www/html/public/storage

# Create "storage" directory inside the public storage directory
mkdir -p /var/www/html/storage/app/public/storage
cp -rf /var/www/html/storage/app/public/. /var/www/html/storage/app/public/storage/ 2>/dev/null || true

# Set environment for logs to avoid file permission errors
export LOG_CHANNEL=stderr
export SESSION_DRIVER=array
export CACHE_DRIVER=array

# Check if vendor directory exists, if not, install dependencies
if [ ! -d "/var/www/html/vendor" ]; then
    echo "Installing Composer dependencies..."
    composer install --no-interaction
fi

# Clear config cache
php artisan config:clear

# Start the PHP built-in server
php artisan serve --host=0.0.0.0 --port=80
