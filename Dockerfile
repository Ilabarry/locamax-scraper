FROM php:8.2-apache

# System dependencies
RUN apt-get update && apt-get install -y \
    zip unzip git curl libpng-dev libonig-dev libxml2-dev libzip-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Enable Apache rewrite
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy app
COPY . .

# Install Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Laravel permissions
RUN chown -R www-data:www-data storage bootstrap/cache

# 👉 SINGLE AND CORRECT DOCUMENT ROOT
RUN sed -i 's|/var/www/html|/var/www/html/public|g' \
    /etc/apache2/sites-available/000-default.conf

EXPOSE 80

CMD ["apache2-foreground"]
