FROM php:8.1-fpm

RUN apt update \
    && apt install -y zlib1g-dev g++ git libicu-dev zip libzip-dev zip libpq-dev libmagickwand-dev --no-install-recommends tesseract-ocr imagemagick\
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install intl opcache pdo pdo_pgsql \
    && pecl install apcu imagick\
    && docker-php-ext-enable apcu imagick\
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip

WORKDIR /var/www/sandbox

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
ENV COMPOSER_ALLOW_SUPERUSER 1

COPY ../../../sandbox /var/www/sandbox
RUN cd /var/www/sandbox \
    && composer install --no-scripts --no-plugins
