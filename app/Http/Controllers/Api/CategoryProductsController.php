<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductCollection;

class CategoryProductsController extends Controller
{
    public function index(
        Request $request,
        Category $category
    ): ProductCollection {
        $this->authorize('view', $category);

        $search = $request->get('search', '');

        $products = $category
            ->mainCategoryProducts()
            ->search($search)
            ->latest()
            ->paginate();

        return new ProductCollection($products);
    }

    public function store(Request $request, Category $category): ProductResource
    {
        $this->authorize('create', Product::class);

        $validated = $request->validate([
            'language_id' => ['required', 'exists:languages,id'],
            'author_id' => ['required', 'exists:authors,id'],
        ]);

        $product = $category->mainCategoryProducts()->create($validated);

        return new ProductResource($product);
    }
}
