FROM php:7.2-apache

COPY ./api /api
COPY ./.docker/vhostapi.conf /etc/apache2/sites-available/000-default.conf

WORKDIR /api
RUN apt-get update
RUN apt-get upgrade -y
RUN docker-php-ext-install pdo pdo_mysql mysqli
RUN a2enmod rewrite
RUN service apache2 restart
RUN composer update