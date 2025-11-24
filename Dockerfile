--- STAGE 1: Build de Node (Assets) ---
FROM node:20-alpine AS node_builder WORKDIR /app

COPY package*.json package-lock.json ./ RUN npm ci

COPY . . RUN npm run build

--- STAGE 2: PHP Dependencies (Composer) ---
Usar PHP 8.2 en el stage de composer para evitar incompatibilidades de versión
FROM php:8.2-cli-alpine AS composer_builder WORKDIR /app

Instalar utilidades necesarias y Composer
RUN set -eux;
apk add --no-cache git unzip curl openssl;
curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer;
composer --version

Copiar solo composer.json y composer.lock primero para aprovechar cache de Docker
COPY composer.json composer.lock ./

Copiar resto del proyecto (incluye /build de node_builder)
COPY --from=node_builder /app /app

ENV COMPOSER_ALLOW_SUPERUSER=1 RUN composer install --no-dev --prefer-dist --optimize-autoloader --no-interaction

--- STAGE 3: Final Image A ---
FROM php:8.2-fpm-alpine

RUN set -eux;
apk update;
apk add --no-cache --virtual .build-deps $PHPIZE_DEPS icu-dev sqlite-dev oniguruma-dev libzip-dev;
apk add --no-cache icu sqlite-libs git unzip;
docker-php-ext-configure intl;
docker-php-ext-install -j"$(nproc)" pdo_sqlite bcmath intl mbstring;
docker-php-ext-enable opcache;
apk del .build-deps

WORKDIR /var/www/html

COPY --from=composer_builder /app /var/www/html

Crear fitxer SQLite perquè existeixi al contenidor
RUN mkdir -p database && touch database/database.sqlite

Ajustar permisos
RUN chown -R www-data:www-data /var/www/html
&& chmod -R 775 /var/www/html/storage
&& chmod -R 775 /var/www/html/bootstrap/cache

USER www-data

EXPOSE 9000