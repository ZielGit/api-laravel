FROM php:8.2-fpm-alpine

# Establecer el directorio de trabajo
WORKDIR /var/www/html

# Instalar dependencias del sistema
RUN apk add --no-cache \
    mysql-client \
    msmtp \
    perl \
    wget \
    procps \
    shadow \
    libzip \
    libpng \
    libjpeg-turbo \
    libwebp \
    freetype \
    icu

# Instalar extensiones PHP
RUN apk add --no-cache --virtual build-essentials \
    icu-dev \
    icu-libs \
    zlib-dev \
    g++ \
    make \
    automake \
    autoconf \
    libzip-dev \
    libpng-dev \
    libwebp-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    && docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install \
        gd \
        mysqli \
        pdo_mysql \
        intl \
        bcmath \
        opcache \
        exif \
        zip \
    && docker-php-ext-enable opcache \
    && apk del build-essentials \
    && rm -rf /usr/src/php*

# Configurar usuario y permisos
RUN addgroup -g 1000 laravel && adduser -G laravel -g laravel -s /bin/sh -D laravel

# Configurar permisos para Laravel
RUN chown -R laravel /var/www/html

# Copiar archivos de la aplicación
COPY --chown=laravel:laravel . .

USER laravel
