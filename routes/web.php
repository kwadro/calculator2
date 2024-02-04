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

Route::post('/addtocart', [App\Http\Controllers\ProductCartController::class, 'addItem'])->name('add_to_cart_form');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/festive', [App\Http\Controllers\FestiveController::class, 'festive'])->name('festiveform');
Route::get('/festive', [App\Http\Controllers\FestiveController::class, 'index'])->name('festiveform');
Route::get('/festive/{festive_id}', [App\Http\Controllers\FestiveController::class, 'index'])->name('festiveindex');
Route::get('/recipes', [App\Http\Controllers\RecipeListController::class, 'index'])->name('recipetypelistindex');
Route::get('/recipe/{recipe_id}', [App\Http\Controllers\RecipeController::class, 'index'])->name('recipeindex');
Route::get('/recipetype/{type}', [App\Http\Controllers\RecipetypeController::class, 'index'])->name('recipetypeindex');
Route::get('/recipeauthor/{author}', [App\Http\Controllers\RecipeauthorController::class, 'index'])->name('recipeautorindex');
Route::get('/contact', [App\Http\Controllers\ContactController::class, 'index'])->name('contactindex');
Route::get('/productcart', [App\Http\Controllers\ProductCartController::class, 'index'])->name('productcartindex');
Route::post('/productcart', [App\Http\Controllers\ProductCartController::class, 'index'])->name('productcartupdate');


Route::get('/product/{product_id}', [App\Http\Controllers\ProductController::class, 'index'])->name('productindex');
Route::get('/category/{category_id}', [App\Http\Controllers\CategoryController::class, 'index'])->name('categoryindex');
