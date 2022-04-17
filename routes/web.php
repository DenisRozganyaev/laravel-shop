<?php

use App\Http\Controllers\Account\Socials\TelegramCallbackController;
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

Route::get('language/{locale}', function($locale) {
    app()->setLocale($locale);
    session()->put('locale', $locale);

    return redirect()->back();
})->name('language.switch');

Route::delete('ajax/images/{image_id}', \App\Http\Controllers\Ajax\RemoveImageController::class)
    ->middleware(['auth', 'admin'])
    ->name('ajax.products.images.delete');

// localhost/admin/.... route(admin.products)
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function() {
    Route::get('/', BoardController::class)->name('home');

    Route::resource('products', ProductsController::class)->except(['show']);

    Route::name('orders')->group(function() {
        Route::get('orders', [\App\Http\Controllers\Admin\OrdersController::class, 'index']);
        Route::get('orders/{order}/edit', [\App\Http\Controllers\Admin\OrdersController::class, 'edit'])->name('.edit');
        Route::put('orders/{order}', [\App\Http\Controllers\Admin\OrdersController::class, 'update'])->name('.update');
    });
});

Route::prefix('account')->name('account.')->middleware(['auth'])->group(function() {
    Route::get('/', [UserController::class, 'index'])->name('main');
    Route::get('{user}/edit', [UserController::class, 'edit'])->middleware('can:view,user')->name('edit');
    Route::put('{user}', [UserController::class, 'update'])->name('update'); // TODO: ->middleware('can:update,user')
    Route::get('wishlist', \App\Http\Controllers\Account\WishListController::class)->name('wishlist');

    Route::get('orders', [\App\Http\Controllers\Account\OrdersController::class, 'index'])->name('orders.list');
    Route::get('orders/{order}', [\App\Http\Controllers\Account\OrdersController::class, 'show'])->name('orders.show');
    Route::post('orders/{order}/cancel', [\App\Http\Controllers\Account\OrdersController::class, 'cancel'])->name('orders.cancel');

    Route::get('telegram/callback', TelegramCallbackController::class)->name('telegram.callback');
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

    Route::post('rating/{product}/add', [\App\Http\Controllers\RatingController::class, 'add'])->name('rating.add');

    Route::post('comment/store', [\App\Http\Controllers\CommentsController::class, 'store'])->name('comment.add');
    Route::post('comment/reply', [\App\Http\Controllers\CommentsController::class, 'reply'])->name('comment.reply');
});
