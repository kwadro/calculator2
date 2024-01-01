<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/festive', [App\Http\Controllers\FestiveController::class, 'festive'])->name('festiveform');
Route::get('/festive', [App\Http\Controllers\FestiveController::class, 'create'])->name('festiveform');
Route::get('/festive/{festive_id}', [App\Http\Controllers\FestiveController::class, 'index'])->name('festiveindex');
Route::get('/recipe/{recipe_id}', [App\Http\Controllers\RecipeController::class, 'index'])->name('recipeindex');
Route::get('/recipetype/{type}', [App\Http\Controllers\RecipetypeController::class, 'index'])->name('recipetypeindex');
Route::get('/recipeauthor/{author}', [App\Http\Controllers\RecipeauthorController::class, 'index'])->name('recipeautorindex');
Route::get('/product/{product_id}', [App\Http\Controllers\ProductController::class, 'index'])->name('productindex');
Route::get('/category/{category_id}', [App\Http\Controllers\CategoryController::class, 'index'])->name('categoryindex');
