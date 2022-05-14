<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(["prefix" => "auth"], function () {
    Route::post("login", [AuthController::class, 'login'])->name("login");
    Route::post("register", [AuthController::class, 'register']);
    Route::group(["middleware" => "auth:api"], function () {
        Route::get("logout", [AuthController::class, 'logout']);
        Route::get("user", [AuthController::class, 'user']);
    });
});

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
//
//Route::post('login', \App\Http\Controllers\Api\AuthController::class)->name('login');
//
Route::middleware(['api', 'api_version:v1'])->prefix('v1')->group(function() {
    require base_path('routes/api/api_v1.php');
});
//
//Route::middleware(['api', 'api_version:v2'])->prefix('v2')->group(function() {
//    require base_path('routes/api/api_v2.php');
//});
