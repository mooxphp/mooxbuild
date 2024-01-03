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
            'uid' => ['required', 'max:255'],
            'sku' => ['required', 'max:255', 'string'],
            'title' => ['required', 'max:255', 'string'],
            'slug' => ['required', 'max:255', 'string'],
            'short' => ['nullable', 'max:255', 'string'],
            'content' => ['nullable', 'max:255', 'string'],
            'data' => ['nullable', 'max:255', 'json'],
            'image' => ['nullable', 'image', 'max:1024'],
            'thumbnail' => ['nullable', 'file'],
            'author_id' => ['required', 'exists:authors,id'],
            'created_by_user_id' => ['required', 'max:255', 'string'],
            'created_by_user_name' => ['required', 'max:255', 'string'],
            'edited_by_user_id' => ['required', 'max:255', 'string'],
            'edited_by_user_name' => ['required', 'max:255', 'string'],
            'language_id' => ['nullable', 'exists:languages,id'],
            'translation_id' => ['nullable', 'exists:products,id'],
            'published_at' => ['nullable', 'date'],
            'price' => ['required', 'numeric'],
            'stock' => ['required', 'max:255'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request
                ->file('thumbnail')
                ->store('public');
        }

        $product = $category->mainCategoryProducts()->create($validated);

        return new ProductResource($product);
    }
}
