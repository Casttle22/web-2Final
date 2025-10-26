# =============== Etapa 1: vendor (Composer) =================
FROM composer:2 AS vendor
WORKDIR /app

# Copiamos solo los manifiestos para cachear vendor
COPY composer.json composer.lock ./

# Instalamos dependencias sin scripts (todavía no existe artisan)
RUN COMPOSER_ALLOW_SUPERUSER=1 composer install \
    --no-dev --prefer-dist --no-interaction --no-scripts

# =============== Etapa 2: assets (Node/Vite) =================
FROM node:22-alpine AS assets
WORKDIR /app

# Manifiestos y config de Vite/Tailwind/PostCSS
COPY package*.json ./
COPY vite.config.js postcss.config.js tailwind.config.js ./

# Código fuente necesario para el build
COPY resources ./resources

# IMPORTANTE: Vite necesita vendor para resolver cosas como livewire/flux.css
COPY --from=vendor /app/vendor ./vendor

# Instalamos y construimos (dev deps SÍ son necesarias para el build)
RUN npm ci --no-audit --no-fund && npm run build

# =============== Etapa 3: runtime (PHP + app) ===============
FROM php:8.2-cli AS app
WORKDIR /app

# Extensiones necesarias
RUN apt-get update \
    && apt-get install -y --no-install-recommends git unzip libpq-dev \
    && docker-php-ext-install pdo_pgsql \
    && rm -rf /var/lib/apt/lists/*

# Copiamos TODO el proyecto
COPY . .

# Traemos vendor cacheado y los assets ya construidos
COPY --from=vendor /app/vendor ./vendor
COPY --from=assets /app/public/build ./public/build
RUN if [ -f public/build/.vite/manifest.json ]; then cp public/build/.vite/manifest.json public/build/manifest.json; fi

# Producción
ENV APP_ENV=production \
    APP_DEBUG=false


# Render inyecta $PORT. Iniciamos migraciones y arrancamos el servidor PHP embebido.
CMD php artisan config:clear \
    && php artisan route:clear \
    && php artisan view:clear \
    && php artisan migrate --force \
    && php -S 0.0.0.0:10000 -t public
