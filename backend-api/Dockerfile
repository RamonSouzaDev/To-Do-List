FROM php:8.1-fpm

# set your user name, ex: user=bernardo
ARG user=ramon
ARG uid=1000

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    && docker-php-ext-install zip

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd sockets

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# Install redis
RUN pecl install -o -f redis \
    &&  rm -rf /tmp/pear \
    &&  docker-php-ext-enable redis

# Set working directory
WORKDIR /var/www

COPY .env.example .env

# Copy custom configurations PHP
COPY docker/php/custom.ini /usr/local/etc/php/conf.d/custom.ini

# Configurar variáveis de ambiente no arquivo .env
RUN echo "DB_CONNECTION=mysql" > .env \
    && echo "DB_HOST=db" >> .env \
    && echo "DB_PORT=3306" >> .env \
    && echo "DB_DATABASE=lista-de-tarefas" >> .env \
    && echo "DB_USERNAME=root" >> .env \
    && echo "DB_PASSWORD=root" >> .env

COPY composer.json composer.lock /var/www/

COPY . /var/www/

USER root
RUN chown -R $user:$user /var/www/coverage && \
    chmod -R 755 /var/www/coverage

USER $user