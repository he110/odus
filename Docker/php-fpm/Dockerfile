FROM php:7.4-fpm

COPY wait-for-it.sh /usr/bin/wait-for-it

RUN chmod +x /usr/bin/wait-for-it
RUN apt-get update && apt-get install -y \
        libmcrypt-dev \
        && apt-get install -y libpq-dev \
        && pecl install mcrypt-1.0.3 \
        && pecl install -o -f redis \
        && pecl install mongodb \
        && docker-php-ext-enable mongodb \
        && docker-php-ext-enable mcrypt \
        && docker-php-ext-install pdo_mysql \
        && docker-php-ext-enable redis
RUN docker-php-ext-install opcache
RUN apt-get install -y git

COPY --from=composer /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

CMD composer install ; wait-for-it database:27017 -- php-fpm

EXPOSE 9000
