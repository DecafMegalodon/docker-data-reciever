from php:8.0-apache as base

RUN docker-php-ext-install mysqli pdo pdo_mysql
copy ./src /var/www/html
