https://httpster.net/

### installation

```bash
composer install
php artisan key:generate
php artisan migrate --seed
npm install
```

### run

```bash
npm run dev
sudo -u www-data php artisan queue:listen
```

### build

```bash
npm run build
php artisan inertia:start-ssr
```
