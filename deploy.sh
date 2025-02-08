#!/bin/bash

set -e

echo "Iniciando despliegue..."

echo "Instalando dependencias con Composer..."
composer install --no-interaction --prefer-dist


echo "Configurando el archivo .env..."
if [ ! -f .env ]; then
    cp .env.example .env
    echo ".env creado desde .env.example"
else
    echo "El archivo .env ya existe"
fi

echo "Ejecutando migraciones y seeders..."
php artisan migrate --force
php artisan db:seed --force


echo "Iniciando el servidor con Artisan..."
php artisan serve --host=0.0.0.0 --port=8000 &


echo "Configurando permisos para storage y bootstrap/cache..."
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

echo "Despliegue completado con éxito."
