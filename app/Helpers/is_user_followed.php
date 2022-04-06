<?php

use App\Models\Product;

if (!function_exists('is_user_followed')) {
    function is_user_followed(Product $product)
    {
        return (bool)auth()->user()->wishes()->find($product->id);
    }
}
