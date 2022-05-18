<?php
Route::prefix('products')->group(function() {
   Route::get('/', [\App\Http\Controllers\Api\V1\ProductsController::class, 'index'])
       ->middleware('scope:view-products');
   Route::get('/{product}', [\App\Http\Controllers\Api\V1\ProductsController::class, 'show']);
});
