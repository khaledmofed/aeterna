#!/bin/sh
set -e

# Render injects PORT env var (default 10000)
PORT="${PORT:-10000}"
sed -i "s/Listen 80/Listen $PORT/g" /etc/apache2/ports.conf
sed -i "s/\*:80/\*:$PORT/g" /etc/apache2/sites-available/000-default.conf

# Cache config/routes/views
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run migrations (--force skips confirmation in production)
php artisan migrate --force

# Seed database (all seeders use updateOrCreate — safe to re-run)
php artisan db:seed --force

echo "Startup complete. Starting Apache on port $PORT..."
exec apache2-foreground
