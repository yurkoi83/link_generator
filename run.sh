#!/bin/bash
echo -n "Начало установки..."
cp .env.example .env
if docker-compose up -d --build; then
    docker-compose exec php-fpm composer install
    docker-compose exec php-fpm php artisan migrate -n --force
    echo "\nГотово. В браузере набираем: http://localhost:8033"
else
        echo "Не удалось запустить контейнеры!!!\n"
fi

