FROM php:8.2-cli

ENV APP_DIR /var/www/html

RUN mkdir -p $APP_DIR
WORKDIR $APP_DIR
EXPOSE 80
VOLUME $APP_DIR

# Install system dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    zip \
    unzip \
    git \
    curl \
    libzip-dev \
    libonig-dev

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Set PHP variables
COPY local.ini /usr/local/etc/php/conf.d/local.ini

# Install composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
COPY composer*.json .
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN composer install --no-scripts --no-autoloader --ansi --no-interaction;

COPY . .
RUN composer dump-autoload -o \
    && chown -R $USER:$GROUP $APP_DIR \
    && chmod -R 755 $APP_DIR

CMD ["php", "-S", "0.0.0.0:80", "-t", "src"]
