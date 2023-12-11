<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Language;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\TagStoreRequest;
use App\Http\Requests\TagUpdateRequest;
use Illuminate\Support\Facades\Storage;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Tag::class);

        $search = $request->get('search', '');

        $tags = Tag::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.tags.index', compact('tags', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Tag::class);

        $languages = Language::pluck('title', 'id');
        $tags = Tag::pluck('title', 'id');

        return view('app.tags.create', compact('languages', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TagStoreRequest $request): RedirectResponse
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

        return redirect()
            ->route('tags.edit', $tag)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Tag $tag): View
    {
        $this->authorize('view', $tag);

        return view('app.tags.show', compact('tag'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Tag $tag): View
    {
        $this->authorize('update', $tag);

        $languages = Language::pluck('title', 'id');
        $tags = Tag::pluck('title', 'id');

        return view('app.tags.edit', compact('tag', 'languages', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        TagUpdateRequest $request,
        Tag $tag
    ): RedirectResponse {
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

        return redirect()
            ->route('tags.edit', $tag)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Tag $tag): RedirectResponse
    {
        $this->authorize('delete', $tag);

        if ($tag->image) {
            Storage::delete($tag->image);
        }

        if ($tag->thumbnail) {
            Storage::delete($tag->thumbnail);
        }

        $tag->delete();

        return redirect()
            ->route('tags.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
