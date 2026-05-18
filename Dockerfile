# 1. Usa la versión de PHP que tengas en tu computadora (ej: php:8.1-apache, php:8.2-apache, php:8.3-apache)
FROM php:8.2-apache

# 2. Instalar TODAS las extensiones comunes que requiere Laravel y sus paquetes asociados
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

# 3. Habilitar el módulo rewrite de Apache
RUN a2enmod rewrite

# 4. Cambiar la raíz de Apache a la carpeta /public de Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# 5. Instalar Composer de forma oficial
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . .

# 6. MODIFICACIÓN CRUCIAL: Añadimos --ignore-platform-reqs para evitar bloqueos de versión en producción
RUN composer install --no-dev --optimize-autoloader --ignore-platform-reqs

# 7. Asignar permisos correctos a las carpetas de almacenamiento
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 80

CMD ["apache2-foreground"]