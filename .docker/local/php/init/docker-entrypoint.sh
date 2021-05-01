#!/bin/bash

set -e

sleep 15

mkdir -p /ecommerce-app/bootstrap/cache
chmod -R 777 /ecommerce-app/bootstrap/cache
chown -R www-data:www-data /ecommerce-app/bootstrap/cache

# generate app key.
#php /ecommerce-app/artisan key:generate --env=testing

# Build cache
php /ecommerce-app/artisan config:cache --env=testing

chmod -R 777 /ecommerce-app/bootstrap/cache
chown -R www-data:www-data /ecommerce-app/bootstrap/cache
chmod -R 777 /ecommerce-app/storage/logs/

php /ecommerce-app/artisan migrate:fresh --env=testing

echo "Migrations executed successfully."

exec "$@"
