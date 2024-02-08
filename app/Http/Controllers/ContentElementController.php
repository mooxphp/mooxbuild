<?php

namespace App\Http\Controllers;

use App\Models\Theme;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\ContentElement;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ContentElementStoreRequest;
use App\Http\Requests\ContentElementUpdateRequest;

class ContentElementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', ContentElement::class);

        $search = $request->get('search', '');

        $contentElements = ContentElement::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.content_elements.index',
            compact('contentElements', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', ContentElement::class);

        $themes = Theme::pluck('title', 'id');

        return view('app.content_elements.create', compact('themes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ContentElementStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', ContentElement::class);

        $validated = $request->validated();
        $validated['data_structure'] = json_decode(
            $validated['data_structure'],
            true
        );

        $contentElement = ContentElement::create($validated);

        return redirect()
            ->route('content-elements.edit', $contentElement)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, ContentElement $contentElement): View
    {
        $this->authorize('view', $contentElement);

        return view('app.content_elements.show', compact('contentElement'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, ContentElement $contentElement): View
    {
        $this->authorize('update', $contentElement);

        $themes = Theme::pluck('title', 'id');

        return view(
            'app.content_elements.edit',
            compact('contentElement', 'themes')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        ContentElementUpdateRequest $request,
        ContentElement $contentElement
    ): RedirectResponse {
        $this->authorize('update', $contentElement);

        $validated = $request->validated();
        $validated['data_structure'] = json_decode(
            $validated['data_structure'],
            true
        );

        $contentElement->update($validated);

        return redirect()
            ->route('content-elements.edit', $contentElement)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        ContentElement $contentElement
    ): RedirectResponse {
        $this->authorize('delete', $contentElement);

        $contentElement->delete();

        return redirect()
            ->route('content-elements.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
