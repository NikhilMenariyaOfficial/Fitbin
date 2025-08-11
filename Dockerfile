FROM php:latest

WORKDIR /var/www/html

RUN apt-get update -y && apt-get upgrade -y \
    && apt-get install -y wget git unzip libzip-dev sqlite3 libsqlite3-dev \
    && docker-php-ext-install zip pdo pdo_mysql pdo_sqlite

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY composer.json composer.lock ./

RUN composer install --no-scripts --no-autoloader

COPY . .

RUN composer dump-autoload

EXPOSE 8000

CMD ["php", "artisan", "serve", "--host", "0.0.0.0", "--port", "8000"]
