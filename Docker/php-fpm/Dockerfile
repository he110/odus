FROM php:7.4-fpm

COPY wait-for-it.sh /usr/bin/wait-for-it

RUN chmod +x /usr/bin/wait-for-it
RUN apt-get update && apt-get install -y \
        libmcrypt-dev \
        && git \
        && apt-get install -y libpq-dev \
        && pecl install mcrypt-1.0.3 \
        && docker-php-ext-enable mcrypt \
        && pecl install mongodb \
        && docker-php-ext-enable mongodb
RUN docker-php-ext-install opcache

COPY --from=composer /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

CMD composer install ; wait-for-it database:27017 -- php-fpm

EXPOSE 9000
