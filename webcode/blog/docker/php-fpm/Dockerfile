FROM php:8.0-fpm

# Set working directory
WORKDIR /var/www

# Add docker php ext repo
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

# Install php extensions
RUN chmod +x /usr/local/bin/install-php-extensions && sync && \
    install-php-extensions mbstring pdo_mysql zip exif pcntl gd memcached

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    unzip \
    git \
    curl \
    lua-zlib-dev \
    libmemcached-dev \
    nginx


RUN mkdir -p /usr/src/php/ext/redis \
    && curl -L https://github.com/phpredis/phpredis/archive/5.3.4.tar.gz | tar xvz -C /usr/src/php/ext/redis --strip 1 \
    && echo 'redis' >> /usr/src/php-available-exts \
    && docker-php-ext-install redis

# Install supervisor
RUN apt-get install -y supervisor

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Add user for laravel application
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www


# PHP Error Log Files
# RUN mkdir /var/log/php
# RUN touch /var/log/php/errors.log && chmod 777 /var/log/php/errors.log

# Deployment steps
#RUN composer install --optimize-autoloader --no-dev

# Copy nginx/php/supervisor configs
COPY ./config/supervisord/conf.d/supervisor.conf /etc/supervisord.conf

# Copy config
COPY ./config/php/local.ini /usr/local/etc/php/conf.d/local.ini

RUN chown www:www /var/www
COPY --chown=www:www . /var/www/

# add root to www group
RUN chmod -R ug+w /var/www/storage

RUN ["chmod", "+x", "./start_script.sh"]

EXPOSE 9000

RUN chmod -R 775 /var/www/storage
USER www

# Run php-fpm
CMD ["./start_script.sh"]