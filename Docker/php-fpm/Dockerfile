FROM php:fpm-alpine

COPY wait-for-it.sh /usr/bin/wait-for-it

RUN chmod +x /usr/bin/wait-for-it
RUN apt-get update && apt-get install -y \
        libmcrypt-dev \
        && apt-get install -y libpq-dev \
        && docker-php-ext-install -j$(nproc) mcrypt \
        && pecl install mongodb
        && docker-php-ext-enable mongodb
RUN docker-php-ext-install mbstring
RUN docker-php-ext-install opcache

COPY --from=composer /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

CMD composer install ; wait-for-it database:27017 -- bin/console doctrine:migrations:migrate ;  php-fpm

EXPOSE 9000
