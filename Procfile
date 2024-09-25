postdeploy: php artisan migrate --no-interaction --force && npm install && npm run build
queues: php artisan horizon
scheduler: php artisan schedule:daemon
web: php artisan inertia:start-ssr & bin/run
