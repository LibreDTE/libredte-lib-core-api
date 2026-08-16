# Etapa 1: dependencias de Composer (sin dev-dependencies).
FROM composer:2 AS composer

WORKDIR /app

COPY composer.json composer.lock ./
RUN composer install \
    --no-dev \
    --no-scripts \
    --no-interaction \
    --optimize-autoloader \
    --ignore-platform-reqs

# Etapa 2: imagen de ejecución.
#
# FrankenPHP ya trae un Caddyfile por defecto que sirve el directorio
# `public/` (coincide con el de este proyecto) y escucha en `SERVER_NAME`.
# No se necesita ningún Caddyfile propio.
FROM dunglas/frankenphp:1-php8.5

RUN install-php-extensions gd intl soap

WORKDIR /app

COPY . .
COPY --from=composer /app/vendor ./vendor

# Puerto interno fijo (estándar HTTP). El puerto externo se elige al correr
# el contenedor con `-p <puerto-externo>:80`, sin relación con este valor.
ENV SERVER_NAME=:80
ENV APP_URL=http://localhost:8080
EXPOSE 80
