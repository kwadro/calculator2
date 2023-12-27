<?php

use App\Admin\Controllers\CategoryController;
use App\Admin\Controllers\MeasureController;
use App\Admin\Controllers\ProductController;
use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('products', ProductController::class);
    $router->resource('category', CategoryController::class);
    $router->resource('measures', MeasureController::class);
});
