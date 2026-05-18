FROM servd/laravel:8.1-apache

# Copiar el código del proyecto al contenedor
COPY . /var/www/html

# Configurar permisos para Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Instalar dependencias de composer
RUN composer install --no-dev --optimize-autoloader

# Exponer el puerto por defecto
EXPOSE 80