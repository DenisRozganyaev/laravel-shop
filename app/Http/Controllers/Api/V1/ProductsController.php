<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\ProductsRequest;
use App\Http\Resources\V1\ProductCollection;
use App\Http\Resources\V1\ProductResource;
use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductsController extends Controller
{
    public function index(ProductsRequest $request)
    {
        try {
            $products = Product::all();
            return new ProductCollection($products);
        } catch (ModelNotFoundException $exception) {
            return response()->json(['message' => $exception->getMessage()], 404);
        }
    }

    public function show(Product $product)
    {
        return new ProductResource($product);
    }
}
