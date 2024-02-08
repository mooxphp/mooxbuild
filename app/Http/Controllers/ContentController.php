<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\ContentElement;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ContentStoreRequest;
use App\Http\Requests\ContentUpdateRequest;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Content::class);

        $search = $request->get('search', '');

        $contents = Content::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.contents.index', compact('contents', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Content::class);

        $contentElements = ContentElement::pluck('title', 'id');

        return view('app.contents.create', compact('contentElements'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ContentStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Content::class);

        $validated = $request->validated();
        $validated['data'] = json_decode($validated['data'], true);

        $validated['settings'] = json_decode($validated['settings'], true);

        $content = Content::create($validated);

        return redirect()
            ->route('contents.edit', $content)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Content $content): View
    {
        $this->authorize('view', $content);

        return view('app.contents.show', compact('content'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Content $content): View
    {
        $this->authorize('update', $content);

        $contentElements = ContentElement::pluck('title', 'id');

        return view('app.contents.edit', compact('content', 'contentElements'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        ContentUpdateRequest $request,
        Content $content
    ): RedirectResponse {
        $this->authorize('update', $content);

        $validated = $request->validated();
        $validated['data'] = json_decode($validated['data'], true);

        $validated['settings'] = json_decode($validated['settings'], true);

        $content->update($validated);

        return redirect()
            ->route('contents.edit', $content)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Content $content
    ): RedirectResponse {
        $this->authorize('delete', $content);

        $content->delete();

        return redirect()
            ->route('contents.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
