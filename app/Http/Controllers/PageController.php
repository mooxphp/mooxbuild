<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Author;
use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\PageStoreRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\PageUpdateRequest;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Page::class);

        $search = $request->get('search', '');

        $pages = Page::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.pages.index', compact('pages', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Page::class);

        $categories = Category::pluck('title', 'id');
        $authors = Author::pluck('title', 'id');
        $pages = Page::pluck('title', 'id');

        return view(
            'app.pages.create',
            compact('categories', 'authors', 'pages')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PageStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Page::class);

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

        $page = Page::create($validated);

        return redirect()
            ->route('pages.edit', $page)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Page $page): View
    {
        $this->authorize('view', $page);

        return view('app.pages.show', compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Page $page): View
    {
        $this->authorize('update', $page);

        $categories = Category::pluck('title', 'id');
        $authors = Author::pluck('title', 'id');
        $pages = Page::pluck('title', 'id');

        return view(
            'app.pages.edit',
            compact('page', 'categories', 'authors', 'pages')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        PageUpdateRequest $request,
        Page $page
    ): RedirectResponse {
        $this->authorize('update', $page);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            if ($page->image) {
                Storage::delete($page->image);
            }

            $validated['image'] = $request->file('image')->store('public');
        }

        if ($request->hasFile('thumbnail')) {
            if ($page->thumbnail) {
                Storage::delete($page->thumbnail);
            }

            $validated['thumbnail'] = $request
                ->file('thumbnail')
                ->store('public');
        }

        $validated['data'] = json_decode($validated['data'], true);

        $page->update($validated);

        return redirect()
            ->route('pages.edit', $page)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Page $page): RedirectResponse
    {
        $this->authorize('delete', $page);

        if ($page->image) {
            Storage::delete($page->image);
        }

        if ($page->thumbnail) {
            Storage::delete($page->thumbnail);
        }

        $page->delete();

        return redirect()
            ->route('pages.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
