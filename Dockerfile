FROM php:7.2-apache

ARG DBPASS

RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN cp /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini

COPY /package/usr/share/orkidea-stockcontrol /var/www/html/
RUN sed -i 's/localhost/db/g' model/storage.php
RUN sed -i "s/'pass' => ''/'pass' => '$DBPASS'/g" model/storage.php