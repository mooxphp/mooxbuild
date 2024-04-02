<?php

namespace App\Http\Controllers\Api;

use App\Models\Item;
use Illuminate\Http\Request;
use App\Http\Resources\ItemResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\ItemCollection;

class ItemItemsController extends Controller
{
    public function index(Request $request, Item $item): ItemCollection
    {
        $this->authorize('view', $item);

        $search = $request->get('search', '');

        $items = $item
            ->hasTranslations()
            ->search($search)
            ->latest()
            ->paginate();

        return new ItemCollection($items);
    }

    public function store(Request $request, Item $item): ItemResource
    {
        $this->authorize('create', Item::class);

        $validated = $request->validate([
            'uid' => ['required', 'max:255'],
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
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request
                ->file('thumbnail')
                ->store('public');
        }

        $item = $item->hasTranslations()->create($validated);

        return new ItemResource($item);
    }
}
