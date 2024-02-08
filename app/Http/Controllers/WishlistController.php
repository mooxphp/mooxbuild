<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\WishlistStoreRequest;
use App\Http\Requests\WishlistUpdateRequest;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Wishlist::class);

        $search = $request->get('search', '');

        $wishlists = Wishlist::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.wishlists.index', compact('wishlists', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Wishlist::class);

        return view('app.wishlists.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WishlistStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Wishlist::class);

        $validated = $request->validated();

        $wishlist = Wishlist::create($validated);

        return redirect()
            ->route('wishlists.edit', $wishlist)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Wishlist $wishlist): View
    {
        $this->authorize('view', $wishlist);

        return view('app.wishlists.show', compact('wishlist'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Wishlist $wishlist): View
    {
        $this->authorize('update', $wishlist);

        return view('app.wishlists.edit', compact('wishlist'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        WishlistUpdateRequest $request,
        Wishlist $wishlist
    ): RedirectResponse {
        $this->authorize('update', $wishlist);

        $validated = $request->validated();

        $wishlist->update($validated);

        return redirect()
            ->route('wishlists.edit', $wishlist)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Wishlist $wishlist
    ): RedirectResponse {
        $this->authorize('delete', $wishlist);

        $wishlist->delete();

        return redirect()
            ->route('wishlists.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
