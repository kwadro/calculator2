composer require open-admin-org/open-admin
php artisan vendor:publish --provider="OpenAdmin\Admin\AdminServiceProvider"
php artisan admin:install
composer require open-admin-ext/helpers
php artisan admin:import helpers
composer require open-admin-ext/ckeditor:"1.0.2" -W
php artisan vendor:publish --tag=open-admin-ckeditor
php artisan optimize:clear
php artisan cache:clear
php artisan migrate:rollback --step=1
php artisan make:migration add_count_serving_to_recipe_table --table=recipe
php artisan make:controller
npm install
npm run dev
php artisan make:migration add_image_to_recipe_table --table=recipetype
