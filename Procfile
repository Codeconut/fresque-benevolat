postdeploy: php artisan migrate --no-interaction --force
queues: php artisan horizon
scheduler: php artisan scheduler:daemon
web: php artisan inertia:start-ssr & vendor/bin/heroku-php-apache2 public/
