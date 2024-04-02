<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Author;
use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ItemStoreRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ItemUpdateRequest;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Item::class);

        $search = $request->get('search', '');

        $items = Item::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.items.index', compact('items', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Item::class);

        $categories = Category::pluck('title', 'id');
        $authors = Author::pluck('title', 'id');
        $items = Item::pluck('title', 'id');

        return view(
            'app.items.create',
            compact('categories', 'authors', 'items')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ItemStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Item::class);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request
                ->file('thumbnail')
                ->store('public');
        }

        $validated['data'] = json_decode($validated['data'], true);

        $item = Item::create($validated);

        return redirect()
            ->route('items.edit', $item)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Item $item): View
    {
        $this->authorize('view', $item);

        return view('app.items.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Item $item): View
    {
        $this->authorize('update', $item);

        $categories = Category::pluck('title', 'id');
        $authors = Author::pluck('title', 'id');
        $items = Item::pluck('title', 'id');

        return view(
            'app.items.edit',
            compact('item', 'categories', 'authors', 'items')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        ItemUpdateRequest $request,
        Item $item
    ): RedirectResponse {
        $this->authorize('update', $item);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            if ($item->image) {
                Storage::delete($item->image);
            }

            $validated['image'] = $request->file('image')->store('public');
        }

        if ($request->hasFile('thumbnail')) {
            if ($item->thumbnail) {
                Storage::delete($item->thumbnail);
            }

            $validated['thumbnail'] = $request
                ->file('thumbnail')
                ->store('public');
        }

        $validated['data'] = json_decode($validated['data'], true);

        $item->update($validated);

        return redirect()
            ->route('items.edit', $item)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Item $item): RedirectResponse
    {
        $this->authorize('delete', $item);

        if ($item->image) {
            Storage::delete($item->image);
        }

        if ($item->thumbnail) {
            Storage::delete($item->thumbnail);
        }

        $item->delete();

        return redirect()
            ->route('items.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
