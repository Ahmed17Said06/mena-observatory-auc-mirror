#!/bin/bash
# filepath: c:\Users\qahme\OneDrive\Desktop\AUC\wetransfer_menaobservatory-main-zip_2025-02-24_2301\menaobservatory-main\menaobservatory-main\setup-storage.sh

echo "Setting up storage directory..."

# Create required directories
mkdir -p /var/www/html/storage/framework/sessions 
mkdir -p /var/www/html/storage/framework/views 
mkdir -p /var/www/html/storage/framework/cache
mkdir -p /var/www/html/storage/app/public
mkdir -p /var/www/html/bootstrap/cache

# Set proper bootstrap/cache permissions
chmod -R 775 /var/www/html/bootstrap/cache  # Add this line
chown -R www-data:www-data /var/www/html/bootstrap/cache  # Add this line

# If the host has images, copy them to the storage volume directly
if [ -d "/var/www/html/host-storage" ] && [ "$(ls -A /var/www/html/host-storage)" ]; then
    echo "Copying images from host directory to storage volume..."
    cp -rf /var/www/html/host-storage/* /var/www/html/storage/app/public/
fi

# Set proper ownership
chown -R www-data:www-data /var/www/html/storage

# Create correct symbolic link structure - THIS IS THE FIX FOR THE DOUBLE STORAGE ISSUE
rm -f /var/www/html/public/storage
ln -sf /var/www/html/storage/app/public /var/www/html/public/storage

# SPECIAL FIX: Create a "storage" directory inside the public storage directory
# This handles the database paths that include "storage/" prefix
mkdir -p /var/www/html/storage/app/public/storage
cp -rf /var/www/html/storage/app/public/*.* /var/www/html/storage/app/public/storage/ 2>/dev/null || true

# Set environment for logs to avoid file permission errors
export LOG_CHANNEL=stderr
export SESSION_DRIVER=array
export CACHE_DRIVER=array

# Clear config cache
php artisan config:clear

# Start the PHP built-in server
echo "Storage setup complete - PHP-FPM will be started by the container entrypoint"