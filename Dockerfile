# 1. Base oficial de PHP con Apache
FROM php:8.2-apache

# 2. Instalar herramientas del sistema y librerías necesarias
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    libxml2-dev \
    libonig-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql gd zip xml mbstring bcmath

# 3. INSTALAR NODE.JS Y NPM (Crucial para compilar Vite)
RUN curl -fsSL https://nodesource.com | bash - \
    && apt-get install -y nodejs

# 4. Habilitar reescritura de rutas en Apache
RUN a2enmod rewrite

# 5. Apuntar la raíz de Apache a la carpeta /public de Laravel y ajustar puertos dinámicos de Render
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
RUN sed -ri -e 's!Listen 80!Listen ${PORT}!g' /etc/apache2/ports.conf /etc/apache2/sites-available/*.conf

# 6. Descargar Composer oficial
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER=1

WORKDIR /var/www/html
COPY . .

# 7. Instalar dependencias de backend (PHP)
RUN composer install --no-dev --optimize-autoloader --ignore-platform-reqs --no-scripts

# 8. INSTALAR DEPENDENCIAS DE FRONTEND Y COMPILAR VITE PARA PRODUCCIÓN
RUN npm install
RUN npm run build

# 9. Permisos requeridos para que Laravel pueda escribir logs y cachés sin dar error
RUN chown -R www-data:www-data /var/www/html && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# 10. Script de arranque optimizado para Render
RUN echo '#!/bin/sh\n\
php artisan migrate --force\n\
sed -i "s/Listen 80/Listen ${PORT}/g" /etc/apache2/ports.conf\n\
sed -i "s/<VirtualHost \*:80>/<VirtualHost \*:${PORT}>/g" /etc/apache2/sites-available/*.conf\n\
apache2-foreground' > /usr/local/bin/start.sh

RUN chmod +x /usr/local/bin/start.sh

CMD ["/usr/local/bin/start.sh"]
