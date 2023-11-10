#!/bin/bash

# Copiar .env.example para .env no contêiner
docker exec -i backend-api_app sh -c "cp .env.example .env"

# Executar comandos
docker exec -i backend-api_app sh -c "composer install --ignore-platform-reqs"

docker exec -i backend-api_app sh -c "php artisan key:generate"

docker exec -i backend-api_app sh -c "php artisan passport:keys"

docker exec -i backend-api_app sh -c "php artisan migrate"

docker exec -i backend-api_app sh -c "yes '' | php artisan passport:client --personal"
