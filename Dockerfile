FROM php:8.2-fpm

# Install NGINX
RUN apt-get update && \
    apt-get install -y git \
    unzip \
    libcurl4-openssl-dev 
	

RUN apt-get install -y libpng-dev && \
    docker-php-ext-install gd

RUN apt-get install -y zlib1g-dev libzip-dev && \
    docker-php-ext-install zip
	
	
	

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer


# Remove default NGINX configuration
#RUN rm /etc/nginx/nginx.conf
#COPY nginx.conf /etc/nginx/nginx.conf
#COPY domain.conf /etc/nginx/sites-available
#RUN ln -s /etc/nginx/sites-available/domain.conf /etc/nginx/sites-enabled/

# npm
COPY package.json ./
COPY package-lock.json* ./
RUN apt-get update && \
    apt-get install -y nodejs && \
    apt-get install -y npm


COPY . /var/www/html
RUN docker-php-ext-install pdo_mysql
RUN rm -rf /var/lib/apt/lists/*

# Copy PHP application files
#COPY public/index.php /var/www/html/
COPY composer.json composer.lock /var/www/html/
#COPY vendor /var/www/html/vendor

# Install application dependencies using Composer
COPY composer.json composer.lock ./

RUN composer install --no-dev --optimize-autoloader
COPY --from=composer /usr/bin/composer /usr/bin/composer
COPY composer.json composer.json

#RUN composer install
RUN composer update
RUN chown -R www-data:www-data .
RUN chmod -R 755 .
#RUN chmod 644 index.php
#RUN nginx -t
#RUN service nginx restart
RUN echo 'include_path = ".:/usr/local/lib/php"' >> /usr/local/etc/php/php.ini
WORKDIR /var/www/html

# Expose port 80
#EXPOSE 443
#EXPOSE 80
# Start NGINX and PHP-FPM
CMD service nginx start && php-fpm
CMD php artisan serve --host=0.0.0.0 --port=8091
#CMD ["php", "-S", "0.0.0.0:8080", "-t", "/var/www/html/public/index.php"]



