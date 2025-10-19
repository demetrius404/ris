#!/bin/bash

cd /laravel7

composer install
php artisan migrate:fresh
php artisan test
php artisan serve --host=0.0.0.0 --port=8000

