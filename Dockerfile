FROM php:8.0-fpm

RUN apt-get update && apt-get install -y \
    build-essential \
    default-mysql-client \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-install zip \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug

WORKDIR /var/www/html

COPY . .

RUN composer install --no-dev --no-interaction --optimize-autoloader

RUN php artisan key:generate

CMD php artisan serve --host=0.0.0.0 --port=8000
