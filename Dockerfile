# Use PHP 8.2 with Apache
FROM php:8.2-apache

# Set working directory
WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y --no-install-recommends \
    git \
    curl \
    wget \
    zip \
    unzip \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libsqlite3-dev \
    sqlite3 \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install -j$(nproc) \
    pdo \
    pdo_mysql \
    mbstring \
    xml \
    zip \
    bcmath

# Enable Apache mod_rewrite
RUN a2enmod rewrite \
    && a2enmod headers

# Create Apache site configuration
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Configure Apache for Laravel with proper .htaccess support
RUN cat > /etc/apache2/sites-available/000-default.conf << 'EOF'
<VirtualHost *:8080>
    ServerName localhost
    DocumentRoot /var/www/html/public

    <Directory /var/www/html/public>
        AllowOverride All
        Require all granted
        
        <IfModule mod_rewrite.c>
            RewriteEngine On
            RewriteCond %{REQUEST_FILENAME} !-f
            RewriteCond %{REQUEST_FILENAME} !-d
            RewriteRule ^ index.php [L]
        </IfModule>
    </Directory>

    <FilesMatch \.php$>
        SetHandler application/x-httpd-php
    </FilesMatch>

    php_value display_errors 1
    php_value display_startup_errors 1
    php_value error_log /var/www/html/storage/logs/php-error.log

    ErrorLog ${APACHE_LOG_DIR}/error.log
    CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
EOF

# Copy application files
COPY . .

# Copy .htaccess to public folder
RUN cp .htaccess public/.htaccess || true

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy .env.example to .env first so config can load during composer install
COPY .env.example .env

# Install PHP dependencies (skip scripts to avoid artisan issues during build)
RUN COMPOSER_ALLOW_SUPERUSER=1 composer install --no-dev --optimize-autoloader --no-scripts

# Create necessary directories with proper permissions
RUN mkdir -p storage/framework/cache \
    storage/framework/sessions \
    storage/framework/views \
    storage/logs \
    bootstrap/cache

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage/logs

# Generate application key if not exists
RUN if [ ! -f .env ]; then cp .env.example .env; fi \
    && php artisan key:generate --force || true

# Clear any cached bootstrap files to ensure fresh start
RUN rm -rf /var/www/html/bootstrap/cache/* || true \
    && rm -rf /var/www/html/storage/logs/* || true \
    && touch /var/www/html/storage/logs/laravel.log \
    && chmod 666 /var/www/html/storage/logs/laravel.log

# Configure Apache ports
RUN sed -i 's/Listen 80/Listen 8080/' /etc/apache2/ports.conf

# Create a startup script to ensure permissions and clear caches on container start
RUN cat > /var/www/html/start.sh << 'STARTUP'
#!/bin/bash
set -e

# Ensure storage and bootstrap directories exist
mkdir -p /var/www/html/storage/framework/cache
mkdir -p /var/www/html/storage/framework/sessions
mkdir -p /var/www/html/storage/framework/views
mkdir -p /var/www/html/storage/logs
mkdir -p /var/www/html/bootstrap/cache

# Ensure .env exists
if [ ! -f /var/www/html/.env ]; then
  cp /var/www/html/.env.example /var/www/html/.env
fi

# Fix permissions at runtime BEFORE any artisan commands
chown -R www-data:www-data /var/www/html/storage
chown -R www-data:www-data /var/www/html/bootstrap/cache
chown www-data:www-data /var/www/html/.env
chmod -R 775 /var/www/html/storage
chmod -R 775 /var/www/html/bootstrap/cache
chmod 644 /var/www/html/.env

# Ensure log file is writable
mkdir -p /var/www/html/storage/logs
touch /var/www/html/storage/logs/laravel.log
chmod 666 /var/www/html/storage/logs/laravel.log

# Clear stale bootstrap cache to prevent class resolution errors
rm -f /var/www/html/bootstrap/cache/config.php
rm -f /var/www/html/bootstrap/cache/services.php
rm -f /var/www/html/bootstrap/cache/packages.php

# Make sure APP_KEY is set
if ! grep -q "APP_KEY=base64:" /var/www/html/.env; then
  php /var/www/html/artisan key:generate --force 2>/dev/null || true
fi

# Warm up Laravel cache for better performance
php /var/www/html/artisan config:cache 2>/dev/null || true
php /var/www/html/artisan route:cache 2>/dev/null || true

# Start Apache
exec apache2-foreground
STARTUP

RUN chmod +x /var/www/html/start.sh

# Expose port 8080 (Render uses this)
EXPOSE 8080

# Start using the startup script
CMD ["/var/www/html/start.sh"]
