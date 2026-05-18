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

# 3. Habilitar reescritura de rutas en Apache
RUN a2enmod rewrite

# 4. Apuntar la raíz de Apache a la carpeta /public de Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# 5. Descargar Composer oficial
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Permite ejecutar Composer sin restricciones como superusuario dentro de Docker
ENV COMPOSER_ALLOW_SUPERUSER=1

WORKDIR /var/www/html
COPY . .

# 6. SOLUCIÓN CRUCIAL: Añadimos --no-scripts para congelar la ejecución de Laravel
# hasta que el servidor encienda con sus variables de entorno reales.
RUN composer install --no-dev --optimize-autoloader --ignore-platform-reqs --no-scripts

# 7. Permisos requeridos para las carpetas internas de escritura
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 80

# Ejecutar migraciones automáticamente antes de encender el servidor Apache
CMD php artisan migrate --force && apache2-foreground
