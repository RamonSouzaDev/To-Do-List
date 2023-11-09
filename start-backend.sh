#!/bin/bash

# Copiar .env.example para .env no contêiner
docker exec -i backend-api_app_1 sh -c "cp .env.example .env"

# Executar comandos
docker exec -i backend-api_app_1 sh -c "composer install --ignore-platform-reqs"

docker exec -i backend-api_app_1 sh -c "php artisan key:generate"

docker exec -i backend-api_app_1 sh -c "php artisan passport:keys"

docker exec -i backend-api_app_1 sh -c "php artisan migrate"

docker exec -i backend-api_app_1 sh -c "yes '' | php artisan passport:client --personal"
