#!/bin/bash
# Optimizations for production-like performance

# Clear all caches first
docker-compose exec laravel.test php artisan cache:clear
docker-compose exec laravel.test php artisan config:clear
docker-compose exec laravel.test php artisan route:clear
docker-compose exec laravel.test php artisan view:clear

# Optimize autoloading
docker-compose exec laravel.test composer install --optimize-autoloader --no-dev

# Create storage link if not exists
docker-compose exec laravel.test php artisan storage:link

# Warm up the cache
docker-compose exec laravel.test php artisan config:cache
docker-compose exec laravel.test php artisan view:cache
docker-compose exec laravel.test php artisan event:cache

# Don't cache routes when using mcamara/laravel-localization
# docker-compose exec laravel.test php artisan route:cache

# For Laravel localization with cached routes, use:
docker-compose exec laravel.test php artisan route:trans:cache

# Restart everything to apply changes
docker-compose restart