FROM php:8.2-fpm

RUN apt-get autoremove && apt-get autoclean && apt-get update --fix-missing

RUN apt-get install -y graphicsmagick jpegoptim \
    libpq-dev zlib1g-dev libicu-dev libzip-dev procps \
    libfreetype6-dev libjpeg62-turbo-dev libpng-dev && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-configure intl
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install pdo pdo_mysql mysqli intl -j $(nproc) gd zip

RUN groupadd -g 1000 appuser && useradd -r -u 1000 -g appuser appuser
USER appuser

WORKDIR /var/www/project