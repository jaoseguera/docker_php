FROM php:8.0-apache
WORKDIR /var/www/html

COPY ./local.thinui.com thinui
EXPOSE 80