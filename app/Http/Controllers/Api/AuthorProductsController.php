<?php

namespace App\Http\Controllers\Api;

use App\Models\Author;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductCollection;

class AuthorProductsController extends Controller
{
    public function index(Request $request, Author $author): ProductCollection
    {
        $this->authorize('view', $author);

        $search = $request->get('search', '');

        $products = $author
            ->products()
            ->search($search)
            ->latest()
            ->paginate();

        return new ProductCollection($products);
    }

    public function store(Request $request, Author $author): ProductResource
    {
        $this->authorize('create', Product::class);

        $validated = $request->validate([
            'main_category_id' => ['nullable', 'exists:categories,id'],
            'language_id' => ['required', 'exists:languages,id'],
        ]);

        $product = $author->products()->create($validated);

        return new ProductResource($product);
    }
}
