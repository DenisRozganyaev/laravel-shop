<?php

use App\Http\Controllers\Account\UserController;
use App\Http\Controllers\Admin\BoardController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WishListController;
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

Route::prefix('account')->name('account.')->middleware(['auth'])->group(function() {
    Route::get('/', [UserController::class, 'index'])->name('main');
    Route::get('{user}/edit', [UserController::class, 'edit'])->middleware('can:view,user')->name('edit');
    Route::put('{user}', [UserController::class, 'update'])->name('update'); // TODO: ->middleware('can:update,user')
    Route::get('wishlist', \App\Http\Controllers\Account\WishListController::class)->name('wishlist');
});

Route::resource('categories', CategoriesController::class)->only(['show', 'index']);
Route::resource('products', \App\Http\Controllers\ProductsController::class)->only(['show', 'index']);
Route::get('cart', [CartController::class, 'index'])->name('cart');
Route::post('cart/{product}', [CartController::class, 'add'])->name('cart.add');
Route::delete('cart', [CartController::class, 'remove'])->name('cart.remove');
Route::post('cart/{product}/count', [CartController::class, 'countUpdate'])->name('cart.count.update');

Route::middleware('auth')->group(function() {
    Route::get('checkout', \App\Http\Controllers\CheckoutController::class)->name('checkout');
    Route::post('order', \App\Http\Controllers\OrdersController::class)->name('order.create');

    Route::get('wishlist/{product}/add', [WishListController::class, 'add'])->name('wishlist.add');
    Route::delete('wishlist/{product}/delete', [WishListController::class, 'delete'])->name('wishlist.delete');
});
