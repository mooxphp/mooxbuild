<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Author;
use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\PostStoreRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\PostUpdateRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Post::class);

        $search = $request->get('search', '');

        $posts = Post::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.posts.index', compact('posts', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Post::class);

        $categories = Category::pluck('title', 'id');
        $authors = Author::pluck('title', 'id');
        $posts = Post::pluck('title', 'id');

        return view(
            'app.posts.create',
            compact('categories', 'authors', 'posts')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostStoreRequest $request): RedirectResponse
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

        return redirect()
            ->route('posts.edit', $post)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Post $post): View
    {
        $this->authorize('view', $post);

        return view('app.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Post $post): View
    {
        $this->authorize('update', $post);

        $categories = Category::pluck('title', 'id');
        $authors = Author::pluck('title', 'id');
        $posts = Post::pluck('title', 'id');

        return view(
            'app.posts.edit',
            compact('post', 'categories', 'authors', 'posts')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        PostUpdateRequest $request,
        Post $post
    ): RedirectResponse {
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

        return redirect()
            ->route('posts.edit', $post)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Post $post): RedirectResponse
    {
        $this->authorize('delete', $post);

        if ($post->image) {
            Storage::delete($post->image);
        }

        if ($post->thumbnail) {
            Storage::delete($post->thumbnail);
        }

        $post->delete();

        return redirect()
            ->route('posts.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
