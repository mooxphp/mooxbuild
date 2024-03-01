<?php

namespace App\Http\Controllers;

use App\Models\WpPost;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\WpPostStoreRequest;
use App\Http\Requests\WpPostUpdateRequest;

class WpPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', WpPost::class);

        $search = $request->get('search', '');

        $wpPosts = WpPost::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.wp_posts.index', compact('wpPosts', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', WpPost::class);

        return view('app.wp_posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WpPostStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', WpPost::class);

        $validated = $request->validated();

        $wpPost = WpPost::create($validated);

        return redirect()
            ->route('wp-posts.edit', $wpPost)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, WpPost $wpPost): View
    {
        $this->authorize('view', $wpPost);

        return view('app.wp_posts.show', compact('wpPost'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, WpPost $wpPost): View
    {
        $this->authorize('update', $wpPost);

        return view('app.wp_posts.edit', compact('wpPost'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        WpPostUpdateRequest $request,
        WpPost $wpPost
    ): RedirectResponse {
        $this->authorize('update', $wpPost);

        $validated = $request->validated();

        $wpPost->update($validated);

        return redirect()
            ->route('wp-posts.edit', $wpPost)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, WpPost $wpPost): RedirectResponse
    {
        $this->authorize('delete', $wpPost);

        $wpPost->delete();

        return redirect()
            ->route('wp-posts.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
