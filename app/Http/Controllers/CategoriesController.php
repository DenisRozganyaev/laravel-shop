<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Contracts\Support\Renderable;

class CategoriesController extends Controller
{
    public function show(Category $category): Renderable
    {
        return view('categories.show', compact('category'));
    }
}
