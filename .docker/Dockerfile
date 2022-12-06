FROM php:7.4-apache

#Dependencies
#RUN apt-get update && apt-get install -y libmcrypt-dev \
 #   mysql-client libmagickwand-dev --no-install-recommends \
  #  && pecl install imagick \
   # && docker-php-ext-enable imagick \
#&& docker-php-ext-install mcrypt pdo_mysql

#Instalamos los paquetes necesarios
RUN apt-get update
RUN apt-get install -y vim git zip

RUN docker-php-ext-install pdo pdo_mysql

#Install composer.
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

#Habilitamos modulos de apache
RUN a2enmod rewrite
RUN a2enmod headers
#Para poder listar directorioslsv
RUN a2enmod autoindex

#Publish web directory
#COPY . /var/www/html
#https://computingforgeeks.com/how-to-install-latest-php-on-debian/
#EXPOSE 8083
