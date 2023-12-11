<?php

namespace App\Http\Controllers\Api;

use App\Models\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductCollection;

class LanguageProductsController extends Controller
{
    public function index(
        Request $request,
        Language $language
    ): ProductCollection {
        $this->authorize('view', $language);

        $search = $request->get('search', '');

        $products = $language
            ->products()
            ->search($search)
            ->latest()
            ->paginate();

        return new ProductCollection($products);
    }

    public function store(Request $request, Language $language): ProductResource
    {
        $this->authorize('create', Product::class);

        $validated = $request->validate([
            'main_category_id' => ['nullable', 'exists:categories,id'],
            'author_id' => ['required', 'exists:authors,id'],
        ]);

        $product = $language->products()->create($validated);

        return new ProductResource($product);
    }
}
