#!/bin/bash

docker exec -it backend-api_app_1 /bin/sh -c "composer install && php artisan migrate && yes '' | php artisan passport:client --personal"
