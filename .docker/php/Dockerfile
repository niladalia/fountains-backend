FROM php:8.3-fpm-alpine

RUN apk --update upgrade \
    && apk add --no-cache autoconf automake make gcc g++ git bash icu-dev libzip-dev rabbitmq-c rabbitmq-c-dev linux-headers zip unzip supervisor vim --force-missing-repositories
    
COPY .docker/php/php.ini /usr/local/etc/php/conf.d/docker-php-config.ini

COPY .docker/xdebug-config.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

COPY .docker/php-fpm-www.conf /usr/local/etc/php-fpm.d/www.conf

RUN apk add --no-cache postgresql-dev

RUN docker-php-ext-install pdo_pgsql

RUN pecl install apcu-5.1.23 && pecl install amqp-2.1.1 && pecl install xdebug-3.3.0

RUN docker-php-ext-enable amqp apcu xdebug

RUN ln -snf /usr/share/zoneinfo/Europe/Madrid /etc/localtime && echo Europe/Madrid > /etc/timezone \
    && printf '[PHP]\ndate.timezone = "%s"\n', Europe/Madrid > /usr/local/etc/php/conf.d/tzone.ini \
    && "date"

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer --version

WORKDIR /var/www/fountains

COPY . .