FROM php:8.2-apache

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev \
    libonig-dev \
    zip \
    unzip \
    curl \
    && docker-php-ext-install \
        pdo \
        pdo_pgsql \
        pgsql \
        zip \
        mbstring \
        opcache \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# PHP upload limits for large APK files
RUN { \
    echo 'upload_max_filesize = 300M'; \
    echo 'post_max_size = 300M'; \
    echo 'memory_limit = 512M'; \
    echo 'max_execution_time = 300'; \
    echo 'max_input_time = 300'; \
} > /usr/local/etc/php/conf.d/uploads.ini

# Enable Apache modules
RUN a2enmod rewrite headers

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Install PHP dependencies (cached layer)
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-scripts

# Copy application
COPY . .
RUN composer dump-autoload --optimize

# Set permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Apache VirtualHost
RUN { \
    echo '<VirtualHost *:80>'; \
    echo '    DocumentRoot /var/www/html/public'; \
    echo '    <Directory /var/www/html/public>'; \
    echo '        AllowOverride All'; \
    echo '        Require all granted'; \
    echo '        Options -Indexes +FollowSymLinks'; \
    echo '    </Directory>'; \
    echo '    ErrorLog /dev/stderr'; \
    echo '    CustomLog /dev/stdout combined'; \
    echo '</VirtualHost>'; \
} > /etc/apache2/sites-available/000-default.conf

# Startup script (inline to avoid Windows CRLF issues)
COPY startup.sh /usr/local/bin/startup.sh
RUN sed -i 's/\r$//' /usr/local/bin/startup.sh \
    && chmod +x /usr/local/bin/startup.sh

EXPOSE 80

CMD ["/usr/local/bin/startup.sh"]
