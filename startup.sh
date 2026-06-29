#!/bin/sh
set -e

# Render injects PORT env var (default 10000)
PORT="${PORT:-8080}"
sed -i "s/Listen 80/Listen $PORT/g" /etc/apache2/ports.conf
sed -i "s/\*:80/\*:$PORT/g" /etc/apache2/sites-available/000-default.conf

# Read runtime env from App Platform (avoid caching empty APP_KEY from build-time .env)
php artisan config:clear || true

# Run migrations — non-fatal so Apache still starts if DB is unavailable
php artisan migrate --force || echo "[startup] migrate skipped — DB not reachable"

# Ensure storage symlink exists for uploaded investor logos
php artisan storage:link --force || true

# Seed admin user first (critical — runs alone so other seeders can't block it)
php artisan db:seed --class=AdminUserSeeder --force || echo "[startup] admin seeder skipped"

# Seed remaining data — DatabaseSeeder checks _content_seeded flag, skips if DB already populated
php artisan db:seed --force || echo "[startup] full seed skipped"

echo "Startup complete. Starting Apache on port $PORT..."
exec apache2-foreground
