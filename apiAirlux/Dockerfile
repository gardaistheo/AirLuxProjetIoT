FROM php:8.3-apache
 
 ARG WWW_USER=www-data
 
# Set working directory
WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    libzip-dev \
    libcurl4-openssl-dev \
    zip \
    unzip \
    default-mysql-client
 
# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip curl intl
# Copy project    
COPY . /var/www/html
# Copy vhost config
COPY docker/apiAirlux.conf /etc/apache2/sites-available
# Set permissions for project file
RUN chown -R www-data:www-data  /var/www/html \
# give permissions to storage folder and cache folder
&& chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache 
# Enable Apache mods
RUN a2enmod rewrite
# desactive le fichier conf de base
RUN  a2dissite 000-default.conf 
# activer le fichier conf du projet
RUN  a2ensite apiAirlux.conf 
# Get latest Composer
RUN php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer
# compose install
RUN composer install --no-scripts --no-dev --no-interaction --no-ansi 
# Clean cache
RUN apt-get -y autoremove \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* 
RUN apt-get update \
    && apt-get install -y sudo 
 
USER ${WWW_USER}


