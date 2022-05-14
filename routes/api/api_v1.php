<?php
Route::prefix('products')->group(function() {
   Route::get('/', [\App\Http\Controllers\Api\V1\ProductsController::class, 'index']);
   Route::get('/{product}', [\App\Http\Controllers\Api\V1\ProductsController::class, 'show']);
});
