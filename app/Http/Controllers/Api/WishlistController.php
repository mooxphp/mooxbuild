<?php

namespace App\Http\Controllers\Api;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\WishlistResource;
use App\Http\Resources\WishlistCollection;
use App\Http\Requests\WishlistStoreRequest;
use App\Http\Requests\WishlistUpdateRequest;

class WishlistController extends Controller
{
    public function index(Request $request): WishlistCollection
    {
        $this->authorize('view-any', Wishlist::class);

        $search = $request->get('search', '');

        $wishlists = Wishlist::search($search)
            ->latest()
            ->paginate();

        return new WishlistCollection($wishlists);
    }

    public function store(WishlistStoreRequest $request): WishlistResource
    {
        $this->authorize('create', Wishlist::class);

        $validated = $request->validated();

        $wishlist = Wishlist::create($validated);

        return new WishlistResource($wishlist);
    }

    public function show(Request $request, Wishlist $wishlist): WishlistResource
    {
        $this->authorize('view', $wishlist);

        return new WishlistResource($wishlist);
    }

    public function update(
        WishlistUpdateRequest $request,
        Wishlist $wishlist
    ): WishlistResource {
        $this->authorize('update', $wishlist);

        $validated = $request->validated();

        $wishlist->update($validated);

        return new WishlistResource($wishlist);
    }

    public function destroy(Request $request, Wishlist $wishlist): Response
    {
        $this->authorize('delete', $wishlist);

        $wishlist->delete();

        return response()->noContent();
    }
}
