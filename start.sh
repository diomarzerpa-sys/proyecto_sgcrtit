#!/bin/sh
set -e # Detiene el script si ocurre algún error crítico

echo "=== 1. EJECUTANDO MIGRACIONES ==="
php artisan migrate --force

echo "=== 2. EJECUTANDO SEEDERS (POBLANDO TABLAS) ==="
php artisan db:seed --force

echo "=== 3. CONFIGURANDO PUERTOS DE APACHE ==="
sed -i "s/Listen 80/Listen ${PORT}/g" /etc/apache2/ports.conf
sed -i "s/<VirtualHost \*:80>/<VirtualHost \*:${PORT}>/g" /etc/apache2/sites-available/*.conf

echo "=== 4. INIACIANDO APACHE EN PRODUCCIÓN ==="
exec apache2-foreground