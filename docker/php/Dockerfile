FROM php:8.2-fpm-alpine

# Dependencias estrictamente necesarias
RUN apk add --no-cache \
    # local
    curl \
    git \
    unzip \
    libzip-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    oniguruma-dev

# Extensiones PHP esenciales
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
    gd \
    pdo_mysql \
    zip \
    mbstring \
    exif \
    pcntl

# Instalar Composer (sin historial de descargas)
RUN curl -sS https://getcomposer.org/installer | php -- \
    --install-dir=/usr/local/bin \
    --filename=composer \
    --quiet

# Usuario no-root para seguridad - prod
# RUN adduser -D -u 1000 phpuser
# USER phpuser

# Establecer permisos - local
RUN chown -R www-data:www-data /var/www/html

WORKDIR /var/www/html
