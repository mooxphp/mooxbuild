<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductCollection;

class ProductProductsController extends Controller
{
    public function index(Request $request, Product $product): ProductCollection
    {
        $this->authorize('view', $product);

        $search = $request->get('search', '');

        $products = $product
            ->hasTranslations()
            ->search($search)
            ->latest()
            ->paginate();

        return new ProductCollection($products);
    }

    public function store(Request $request, Product $product): ProductResource
    {
        $this->authorize('create', Product::class);

        $validated = $request->validate([
            'uid' => ['required', 'max:255'],
            'sku' => ['required', 'max:255', 'string'],
            'main_category_id' => ['nullable', 'exists:categories,id'],
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

        $product = $product->hasTranslations()->create($validated);

        return new ProductResource($product);
    }
}
