#!/bin/bash

docker exec -i backend-api_app_1 sh -c "php artisan passport:keys"

# Copiar .env.example para .env no contêiner
docker exec -i backend-api_app_1 sh -c "cp .env.example .env"

# Executar comandos
docker exec -i backend-api_app_1 sh -c "composer install --ignore-platform-reqs && php artisan migrate && yes '' | php artisan passport:client --personal"
