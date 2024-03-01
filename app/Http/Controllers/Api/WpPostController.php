<?php

namespace App\Http\Controllers\Api;

use App\Models\WpPost;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\WpPostResource;
use App\Http\Resources\WpPostCollection;
use App\Http\Requests\WpPostStoreRequest;
use App\Http\Requests\WpPostUpdateRequest;

class WpPostController extends Controller
{
    public function index(Request $request): WpPostCollection
    {
        $this->authorize('view-any', WpPost::class);

        $search = $request->get('search', '');

        $wpPosts = WpPost::search($search)
            ->latest()
            ->paginate();

        return new WpPostCollection($wpPosts);
    }

    public function store(WpPostStoreRequest $request): WpPostResource
    {
        $this->authorize('create', WpPost::class);

        $validated = $request->validated();

        $wpPost = WpPost::create($validated);

        return new WpPostResource($wpPost);
    }

    public function show(Request $request, WpPost $wpPost): WpPostResource
    {
        $this->authorize('view', $wpPost);

        return new WpPostResource($wpPost);
    }

    public function update(
        WpPostUpdateRequest $request,
        WpPost $wpPost
    ): WpPostResource {
        $this->authorize('update', $wpPost);

        $validated = $request->validated();

        $wpPost->update($validated);

        return new WpPostResource($wpPost);
    }

    public function destroy(Request $request, WpPost $wpPost): Response
    {
        $this->authorize('delete', $wpPost);

        $wpPost->delete();

        return response()->noContent();
    }
}
