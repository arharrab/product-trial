FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git zip unzip libicu-dev libonig-dev libxml2-dev curl \
    && docker-php-ext-install intl pdo pdo_mysql opcache \
    && pecl install apcu && docker-php-ext-enable apcu

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Set permissions (optionnel selon setup)
RUN chown -R www-data:www-data /var/www

CMD ["php-fpm"]