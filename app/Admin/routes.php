<?php

use App\Admin\Controllers\CategoryController;
use App\Admin\Controllers\ComponentController;
use App\Admin\Controllers\FectiverecipeController;
use App\Admin\Controllers\FestiveController;
use App\Admin\Controllers\MeasureController;
use App\Admin\Controllers\ProductController;
use App\Admin\Controllers\RecipeController;
use App\Admin\Controllers\RecipetypeController;
use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix' => config('admin.route.prefix'),
    'namespace' => config('admin.route.namespace'),
    'middleware' => config('admin.route.middleware'),
    'as' => config('admin.route.prefix') . '.',
], function (Router $router) {
    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('products', ProductController::class);
    $router->resource('category', CategoryController::class);
    $router->resource('measures', MeasureController::class);
    $router->resource('recipe', RecipeController::class);
    $router->resource('components', ComponentController::class);
    $router->resource('categories', CategoryController::class);
    $router->resource('recipetypes', RecipetypeController::class);
    $router->resource('festive', FestiveController::class);
    $router->resource('fectiverecipe', FectiverecipeController::class);
});
