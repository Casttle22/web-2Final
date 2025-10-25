# ---------- 1) Dependencias PHP (Composer) ----------
FROM composer:2 AS vendor
WORKDIR /app

# Solo composer.* para cachear mejor
COPY composer.json composer.lock ./
RUN composer install --no-dev --prefer-dist --no-interaction --optimize-autoloader

# Copiamos todo y optimizamos autoload
COPY . .
RUN composer dump-autoload --optimize

# ---------- 2) Build de assets (Node + Vite) ----------
FROM node:22-alpine AS assets
WORKDIR /app

COPY package*.json ./
RUN npm ci
COPY . .
RUN npm run build

# ---------- 3) Runtime PHP ----------
FROM php:8.2-cli

# Paquetes del sistema y extensión de Postgres
RUN apt-get update \
    && apt-get install -y --no-install-recommends git unzip libpq-dev \
    && docker-php-ext-install pdo_pgsql \
    && rm -rf /var/lib/apt/lists/*

WORKDIR /app

# Copiamos el código
COPY . .

# Vendor desde la etapa Composer
COPY --from=vendor /app/vendor /app/vendor

# Assets compilados desde la etapa Node
COPY --from=assets /app/public/build /app/public/build

# Optimizaciones de Laravel (no requieren DB)
RUN php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache

# Render inyecta $PORT. Levantamos el servidor embebido y usamos tu router server.php
CMD ["bash", "-lc", "php -S 0.0.0.0:${PORT} -t public server.php"]
