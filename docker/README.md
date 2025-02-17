
## Demo

Insert gif or link to demo

# Despliegue de Laravel con Docker

## Pasos para configurar el entorno Docker

### 1. Crear el archivo `docker-compose.yml`
Este archivo define los servicios que se ejecutarán en Docker.

```yaml
version: '3.8'

services:
  app:
    build:
      context: .
      dockerfile: docker/php/Dockerfile
    container_name: laravel_app
    restart: unless-stopped
    working_dir: /var/www/html
    volumes:
      - .:/var/www/html
    networks:
      - laravel-network

  webserver:
    image: nginx:alpine
    container_name: laravel_webserver
    restart: unless-stopped
    ports:
      - "8080:80"
    volumes:
      - .:/var/www/html
      - ./docker/nginx/default.conf:/etc/nginx/conf.d/default.conf
    networks:
      - laravel-network

  db:
    image: mysql:8.0.36
    container_name: laravel_db
    restart: unless-stopped
    environment:
      MYSQL_DATABASE: laravel
      MYSQL_ROOT_PASSWORD: secret
      MYSQL_PASSWORD: secret
      MYSQL_USER: laravel
    volumes:
      - dbdata:/var/lib/mysql
    networks:
      - laravel-network

  node:
    image: node:22
    container_name: laravel_node
    restart: unless-stopped
    working_dir: /var/www/html
    volumes:
      - .:/var/www/html
    ports:
      - "5174:5174"
    entrypoint: ["npm", "run", "dev"]
    networks:
      - laravel-network

volumes:
  dbdata:
    driver: local

networks:
  laravel-network:
    driver: bridge
```

### 2. Crear el archivo `docker/php/Dockerfile`

```dockerfile
FROM php:8.2-fpm-alpine

# Instalar dependencias del sistema
RUN apk add --no-cache \
    curl \
    git \
    unzip \
    libzip-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    oniguruma-dev \
    postgresql-dev

# Configurar e instalar extensiones de PHP
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd pdo_mysql zip mbstring exif pcntl

# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Establecer permisos
RUN chown -R www-data:www-data /var/www/html

WORKDIR /var/www/html
```

### 3. Configurar `vite.config.js`

```javascript
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    server: {
        host: '0.0.0.0',
        port: 5174,
        strictPort: true,
    },
});
```

## Pasos para iniciar el proyecto

### 1. Iniciar el Proyecto

```bash
cp .env.docker .env
docker-compose up -d
```

#### 1. Arrancar contenedores con docker-compose

Si tienes un archivo docker-compose.yml, estos comandos son útiles:



- Si tienes un entorno con Laravel y Livewire en Docker, lo más recomendable es usar:
- Construir y arrancar los contenedores (útil si hiciste cambios en el Dockerfile o las dependencias):
- Reconstruye las imágenes antes de iniciar los contenedores.
    
    ```bash
    docker-compose up -d --build
    ```

- Arrancar los contenedores en segundo plano (detached mode): (Levantar contenedores sin reconstruir las imágenes)

    ```bash
    docker-compose up -d
    ``` 

    ### Desglose del comando:
    1. docker-compose: Este es el comando principal que usas para trabajar con aplicaciones definidas por un archivo docker-compose.yml. Este archivo describe la configuración de los contenedores, redes y volúmenes para una aplicación Docker.

    2. up: Este subcomando se usa para construir, iniciar y ejecutar los contenedores definidos en el archivo docker-compose.yml. Si los contenedores ya están en ejecución, up simplemente los levanta, pero si no existen, los crea primero.

    3. -d: Esta es una opción que significa "detached" (desconectado). Especificar -d hace que los contenedores se ejecuten en segundo plano (en "background"), en lugar de mostrar los logs de los contenedores en la terminal donde ejecutas el comando. Esto es útil si no necesitas ver la salida de los contenedores en tiempo real, y prefieres que se ejecuten en segundo plano.

    4. --build: Esta opción le indica a Docker Compose que construya las imágenes antes de iniciar los contenedores. Esto es útil cuando has realizado cambios en el Dockerfile o en los archivos que afectan la construcción de la imagen (como agregar nuevos paquetes o cambiar el código). Si no usas esta opción, Docker Compose usará las imágenes ya construidas si existen, sin intentar reconstruirlas.


- Ver logs en tiempo real (útil para depuración):

    ```bash
    docker-compose logs -f
    ```

- Parar y eliminar los contenedores y redes creadas (sin eliminar volúmenes ni imágenes):

    ```bash
    docker-compose down
    ```

## Reconstruir los Contenedores por posibles errores

Si hay errores, es recomendable reconstruir los contenedores:

```bash
docker-compose down
docker-compose build --no-cache
docker-compose up -d
```
## Crea un script de configuración para ejecutar manualmente

1. Primero damos permisos (cmd)
   
    ```bash
    docker exec -it docker-nginx sh 
    chmod +x /var/www/html/docker/setup.sh
    ```

2. Para ejecutar un script personalizado una vez levantado todo (cmd)

    ```bash
    docker exec -it docker-php sh /var/www/html/docker/setup.sh
    ```

3. Para correr el migrate  y hacer funcionar el nmp run dev se ejecuta esto en ssh o bash

    ```bash
    docker exec -it docker-php php artisan migrate:fresh
    docker exec -it docker-node sh -c "npm run dev"
    ```

4. otros comandos:

    ```bash
    docker exec -it laravel_app php artisan optimize:clear
    docker exec -it laravel_app php artisan config:clear
    docker exec -it laravel_app php artisan cache:clear
    ```

5. Para entorno produccion si es q no compila el npm run build:

    ```bash
    docker exec -it docker-node sh -c "npm run build"
    ``` 

SSL
-  Instalar Certbot y el plugin de Nginx
    ```bash
    sudo apt install certbot python3-certbot-nginx -y
    ```
- Ejecutar Certbot para generar el certificado SSL

    ```bash
    sudo certbot --nginx -d tu-dominio.com -d www.tu-dominio.com`
    ```
- Verificar que el SSL está activo
  Reinicia Nginx para aplicar los cambios:

    ```bash
    sudo systemctl restart nginx
    ```

