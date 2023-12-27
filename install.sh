composer require open-admin-org/open-admin
php artisan vendor:publish --provider="OpenAdmin\Admin\AdminServiceProvider"
php artisan admin:install
composer require open-admin-ext/helpers
php artisan admin:import helpers
