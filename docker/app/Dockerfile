FROM php:7.4.1-fpm

RUN apt-get update \
    && apt-get install -y libzip-dev \
    apt-get install -y vim \
    docker-php-ext-install \
    pdo_mysql

# nodejs install
RUN curl -sL https://deb.nodesource.com/setup_12.x | bash -
RUN apt-get install -y nodejs

# Extension zip for laravel
RUN docker-php-ext-install zip

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html

# laravel install
RUN composer global require laravel/installer
