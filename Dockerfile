FROM php:8.2-fpm-alpine

# Install PHP extensions
RUN apk add --no-cache --virtual .build-deps icu-dev
RUN docker-php-ext-install pdo pdo_mysql intl

# Set working directory
WORKDIR /var/www/html

# Copy the application code
COPY . /var/www/html

# Install Composer and application dependencies
COPY --from=composer /usr/bin/composer /usr/bin/composer
ENV APP_ENV="prod"
RUN composer install --no-dev --optimize-autoloader
