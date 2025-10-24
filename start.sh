#!/usr/bin/env bash
set -euxo pipefail

# 1) Dependencias PHP (prod)
composer install --no-dev --prefer-dist --optimize-autoloader

# 2) Caches de Laravel
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 3) Migraciones (sin interacción)
php artisan migrate --force --no-interaction || true

# 4) Build de assets (Vite) si hay Node disponible
if command -v npm >/dev/null 2>&1; then
  npm ci
  npm run build
fi

# 5) Servidor PHP (Railway expone $PORT)
php -S 0.0.0.0:${PORT:-8080} -t public
