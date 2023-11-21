composer install

configure .env

php artisan migrate

php artisan db:seed --class=VoyagerDatabaseSeeder

php artisan key:generate

php artisan storage:link

php artisan serve

Go to http://127.0.0.1:8000/admin username : admin@admin.com password : password