FROM php:7.4-apache

RUN apt-get update
RUN apt-get install -y --no-install-recommends git zip unzip libzip-dev zlib1g-dev libmcrypt-dev libpq-dev wget libonig-dev libcurl4-openssl-dev
RUN docker-php-ext-install pdo_pgsql zip curl bcmath

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN a2enmod rewrite
RUN a2enmod ssl