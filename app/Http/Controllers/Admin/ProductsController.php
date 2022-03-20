<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Services\Models\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->paginate(10);

        return view('admin/products/index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('admin/products/new', compact('categories'));
    }

    public function store(CreateProductRequest $request)
    {
        $fields = $request->validated();
        $images = $fields['images'] ?? [];

        try {
            DB::beginTransaction();

            $category = Category::find($fields['category']);
            $product = $category->products()->create($fields);
            ImageService::attach($product, 'images', $images);

            DB::commit();

            return redirect()->route('admin.products.index')
                ->with('status', 'The product "'. $product->title . '" was successfully created!');
        } catch (\Exception $e) {
            DB::rollBack();
            logs()->warning($e->getMessage());
            return redirect()->back()->with('warn', 'Oops, something went wrong. (see logs)');
        }
    }
}
