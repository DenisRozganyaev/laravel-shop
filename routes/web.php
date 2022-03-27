<?php

use App\Http\Controllers\Admin\BoardController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::delete('ajax/images/{image_id}', \App\Http\Controllers\Ajax\RemoveImageController::class)
    ->middleware(['auth', 'admin'])
    ->name('ajax.products.images.delete');

// localhost/admin/.... route(admin.products)
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function() {
    Route::get('/', BoardController::class)->name('home');

    Route::resource('products', ProductsController::class)->except(['show']);
});

Route::resource('categories', CategoriesController::class)->only('show');
