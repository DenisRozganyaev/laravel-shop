<?php

use App\Http\Controllers\Admin\BoardController;
use App\Http\Controllers\Admin\ProductsController;
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


// localhost/admin/.... route(admin.products)
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function() {
    Route::get('/', BoardController::class)->name('home');

    Route::resource('products', ProductsController::class)->except(['show']);
});

