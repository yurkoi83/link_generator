#!/bin/bash
echo -n "Начало установки..."
cp .env.example .env

if docker-compose up -d --build; then
    docker-compose exec composer install
    docker-compose exec php-fpm php artisan migrate -n --force
    echo "\nГотово."
else
        echo "Не удалось запустить контейнеры!!!\n"
fi

