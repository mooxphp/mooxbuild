<?php

namespace App\Http\Controllers\Api;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\TagResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\TagCollection;
use App\Http\Requests\TagStoreRequest;
use App\Http\Requests\TagUpdateRequest;
use Illuminate\Support\Facades\Storage;

class TagController extends Controller
{
    public function index(Request $request): TagCollection
    {
        $this->authorize('view-any', Tag::class);

        $search = $request->get('search', '');

        $tags = Tag::search($search)
            ->latest()
            ->paginate();

        return new TagCollection($tags);
    }

    public function store(TagStoreRequest $request): TagResource
    {
        $this->authorize('create', Tag::class);

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

        $tag = Tag::create($validated);

        return new TagResource($tag);
    }

    public function show(Request $request, Tag $tag): TagResource
    {
        $this->authorize('view', $tag);

        return new TagResource($tag);
    }

    public function update(TagUpdateRequest $request, Tag $tag): TagResource
    {
        $this->authorize('update', $tag);

        $validated = $request->validated();

        if ($request->hasFile('image')) {
            if ($tag->image) {
                Storage::delete($tag->image);
            }

            $validated['image'] = $request->file('image')->store('public');
        }

        if ($request->hasFile('thumbnail')) {
            if ($tag->thumbnail) {
                Storage::delete($tag->thumbnail);
            }

            $validated['thumbnail'] = $request
                ->file('thumbnail')
                ->store('public');
        }

        $validated['data'] = json_decode($validated['data'], true);

        $tag->update($validated);

        return new TagResource($tag);
    }

    public function destroy(Request $request, Tag $tag): Response
    {
        $this->authorize('delete', $tag);

        if ($tag->image) {
            Storage::delete($tag->image);
        }

        if ($tag->thumbnail) {
            Storage::delete($tag->thumbnail);
        }

        $tag->delete();

        return response()->noContent();
    }
}
