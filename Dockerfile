# =========================================================
# PASO 1: Traer Node de la imagen oficial Debian (Evita Alpine)
# =========================================================
FROM node:20-slim AS node_base

# =========================================================
# PASO 2: Construir el servidor Laravel definitivo
# =========================================================
FROM php:8.2-apache

# 1. Instalar herramientas del sistema y librerías de PHP necesarias
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

# 2. INYECTAR NODE Y NPM (Sincronizados nativamente)
COPY --from=node_base /usr/local/lib/node_modules /usr/local/lib/node_modules
COPY --from=node_base /usr/local/bin/node /usr/local/bin/node
RUN ln -s /usr/local/lib/node_modules/npm/bin/npm-cli.js /usr/local/bin/npm

# 3. Habilitar reescritura de rutas en Apache
RUN a2enmod rewrite

# 4. Apuntar la raíz de Apache a /public y configurar el puerto dinámico de Render
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
RUN sed -ri -e 's!Listen 80!Listen ${PORT}!g' /etc/apache2/ports.conf /etc/apache2/sites-available/*.conf

# 5. Traer Composer oficial
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER=1

WORKDIR /var/www/html
COPY . .

# 6. Instalar dependencias de PHP (Laravel) sin ejecutar scripts pesados
RUN composer install --no-dev --optimize-autoloader --ignore-platform-reqs --no-scripts

# 7. COMPILAR VITE PARA PRODUCCIÓN (Ahora sí ejecutará NPM sin errores)
RUN npm install
RUN npm run build

# 8. Permisos correctos para la escritura de logs y cachés
RUN chown -R www-data:www-data /var/www/html && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# =========================================================
# 9. Script de arranque dinámico optimizado para Render
# =========================================================
# Copiamos el archivo start.sh que creamos en la raíz
COPY start.sh /usr/local/bin/start.sh

# Le asignamos permisos de ejecución
RUN chmod +x /usr/local/bin/start.sh

# Ejecutamos el script al iniciar el contenedor
CMD ["/usr/local/bin/start.sh"]