#!/bin/bash

# Clear Laravel Configuration Cache
php artisan config:clear

# Clear Laravel Route Cache
php artisan route:clear

# Clear Laravel View Cache
php artisan view:clear

# Clear Compiled Classes
php artisan clear-compiled

# Clear Laravel Application Cache
php artisan cache:clear

# Optimize Composer Autoloader
composer dump-autoload

# Clear Laravel Optimization Cache
php artisan optimize:clear

# Remove all files from the bootstrap/cache directory
rm -rf bootstrap/cache/*

# Reset Database (if needed)
php artisan migrate:refresh --seed
php artisan migrate --path=database/migrations/migration.php

echo "Laravel project cache cleared and ready for a fresh start!"

php artisan serve
