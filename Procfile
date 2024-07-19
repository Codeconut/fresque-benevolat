postdeploy: php artisan migrate --no-interaction --force
queues: php artisan horizon
scheduler: php artisan schedule:daemon
web: php artisan inertia:start-ssr & bin/run
