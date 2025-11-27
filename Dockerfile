# Use PHP 8.2 with Apache
FROM php:8.2-apache

# Set working directory
WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    wget \
    zip \
    unzip \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libcurl4-openssl-dev \
    pkg-config \
    sqlite3 \
    libsqlite3-dev \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install \
    pdo \
    pdo_mysql \
    pdo_sqlite \
    mbstring \
    xml \
    zip \
    curl \
    bcmath \
    ctype \
    tokenizer

# Enable Apache mod_rewrite
RUN a2enmod rewrite \
    && a2enmod headers \
    && a2enmod http2

# Set Apache DocumentRoot to public directory
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-enabled/000-default.conf \
    && sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/apache2.conf

# Copy .htaccess to public folder
RUN echo '<IfModule mod_rewrite.c>\n\
    <IfModule mod_negotiation.c>\n\
        Options -MultiViews\n\
    </IfModule>\n\
    RewriteEngine On\n\
    RewriteCond %{REQUEST_FILENAME} !-d\n\
    RewriteCond %{REQUEST_URI} (.+)/$\n\
    RewriteRule ^ %1 [L,R=301]\n\
    RewriteCond %{REQUEST_FILENAME} !-d\n\
    RewriteCond %{REQUEST_FILENAME} !-f\n\
    RewriteRule ^ index.php [L]\n\
</IfModule>' > /var/www/html/public/.htaccess

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy application files
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

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
    && chmod -R 775 /var/www/html/bootstrap/cache

# Generate application key if not exists
RUN if [ ! -f .env ]; then cp .env.example .env; fi \
    && php artisan key:generate --force || true

# Expose port 8080 (Render uses this)
EXPOSE 8080

# Set Apache to listen on 8080
RUN sed -i 's/Listen 80/Listen 8080/' /etc/apache2/ports.conf

# Start Apache in foreground
CMD ["apache2-foreground"]
