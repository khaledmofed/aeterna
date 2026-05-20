#!/bin/sh
set -e

# Render injects PORT env var (default 10000)
PORT="${PORT:-10000}"
sed -i "s/Listen 80/Listen $PORT/g" /etc/apache2/ports.conf
sed -i "s/\*:80/\*:$PORT/g" /etc/apache2/sites-available/000-default.conf

# Cache config/routes/views (non-fatal — missing .env key won't block startup)
php artisan config:cache  || true
php artisan route:cache   || true
php artisan view:cache    || true

# Run migrations — non-fatal so Apache still starts if DB is unavailable
php artisan migrate --force || echo "[startup] migrate skipped — DB not reachable"

# Seed admin user first (critical — runs alone so other seeders can't block it)
php artisan db:seed --class=AdminUserSeeder --force || echo "[startup] admin seeder skipped"

# Seed remaining data — non-fatal
php artisan db:seed --force || echo "[startup] full seed skipped"

echo "Startup complete. Starting Apache on port $PORT..."
exec apache2-foreground
