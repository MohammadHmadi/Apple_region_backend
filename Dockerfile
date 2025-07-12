# Use official PHP image with Apache
FROM php:8.2-apache

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    libonig-dev \
    libzip-dev \
    unzip \
    zip \
    git \
    curl \
    && docker-php-ext-install pdo pdo_mysql mbstring zip

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy existing application directory contents
COPY . /var/www/html

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Run composer install
RUN composer install --no-dev --optimize-autoloader

# Set proper permissions (adjust user if needed)
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port 80
EXPOSE 80

# Start Apache server
CMD ["apache2-foreground"]
