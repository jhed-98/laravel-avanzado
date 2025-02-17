#!/bin/sh
# setup.sh - Script para ejecutar después de levantar los contenedores

# 1. Ejecutar Composer (si no existe la carpeta vendor)
if [ ! -d "vendor" ]; then
  echo "Ejecutando Composer..."
  docker exec -it docker-php sh -c "composer install --optimize-autoloader --no-dev"
else
  echo "Composer ya ha sido instalado."
fi

# 2. Ejecutar comandos de Laravel
echo "Ejecutando comandos de Laravel..."
docker exec -it docker-php sh -c "php artisan key:generate"
docker exec -it docker-php sh -c "php artisan optimize:clear"

# 3. Ejecutar Node.js (si no existe node_modules)
if [ ! -d "node_modules" ]; then
  echo "Ejecutando Node.js..."
  docker exec -it docker-node sh -c "npm install"
else
  echo "node_modules ya está instalado."
fi

docker exec -it docker-node sh -c "npm run dev"
