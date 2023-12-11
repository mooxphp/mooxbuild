<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\PostResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostCollection;
use App\Http\Requests\PostStoreRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\PostUpdateRequest;

class PostController extends Controller
{
    public function index(Request $request): PostCollection
    {
        $this->authorize('view-any', Post::class);

        $search = $request->get('search', '');

        $posts = Post::search($search)
            ->latest()
            ->paginate();

        return new PostCollection($posts);
    }

    public function store(PostStoreRequest $request): PostResource
    {
        $this->authorize('create', Post::class);

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

        $post = Post::create($validated);

        return new PostResource($post);
    }

    public function show(Request $request, Post $post): PostResource
    {
        $this->authorize('view', $post);

        return new PostResource($post);
    }

    public function update(PostUpdateRequest $request, Post $post): PostResource
    {
        $this->authorize('update', $post);

        $validated = $request->validated();

        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::delete($post->image);
            }

            $validated['image'] = $request->file('image')->store('public');
        }

        if ($request->hasFile('thumbnail')) {
            if ($post->thumbnail) {
                Storage::delete($post->thumbnail);
            }

            $validated['thumbnail'] = $request
                ->file('thumbnail')
                ->store('public');
        }

        $validated['data'] = json_decode($validated['data'], true);

        $post->update($validated);

        return new PostResource($post);
    }

    public function destroy(Request $request, Post $post): Response
    {
        $this->authorize('delete', $post);

        if ($post->image) {
            Storage::delete($post->image);
        }

        if ($post->thumbnail) {
            Storage::delete($post->thumbnail);
        }

        $post->delete();

        return response()->noContent();
    }
}
