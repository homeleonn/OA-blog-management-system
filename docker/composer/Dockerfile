FROM php:8.0-cli-alpine

RUN apk update && apk add --no-cache unzip curl git zip \
    && curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer

WORKDIR /app
