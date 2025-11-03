# dockerfile pour PHP - FPM
FROM php:8.3-fpm-alpine
LABEL authors="prepa web"

# mise a jour des listes des paquets disponibles
RUN apk update

ENV MUSL_LOCPATH /usr/share/i18/locales/musl 

RUN apk --no-cache add cmake make musl-dev gcc gettext-dev libintl \
    && wget https://gitlab.com/rilian-la-te/musl-locales/-/archive/master/musl-locales-master.zip \
    && unzip musl-locales-master.zip \
    && cd musl-locales-master \
    && cmake -DLOCALE_PROFILE=OFF -D CMAKE_INSTALL_PREFIX:PATH=/usr . && make && make install \
    && cd .. && rm -rf musl-locales-master 

RUN apk add autoconf g++ curl-dev pkgconfig libpng-dev libjpeg-turbo-dev \
    libwebp-dev freetype-dev libzip-dev libstdc++ libx11 libxrender libxext \
    libssl3 ca-certificates

# definition des locales 
ENV TZ Europe/Paris
ENV LANG fr_FR.UTF-8
ENV LANGUAGE fr_FR:fr
ENV LC_ALL fr_FR.UTF-8

# installation des extensions PHP
RUN apk add --no-cache icu-dev \
    && docker-php-ext-install pdo pdo_mysql \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl \
    && docker-php-ext-enable intl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd opcache \
    && docker-php-ext-enable opcache

# installation de composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# rep de travail 
WORKDIR /var/www/html


