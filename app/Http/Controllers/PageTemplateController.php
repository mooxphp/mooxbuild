<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\View\View;
use App\Models\PageTemplate;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\PageTemplateStoreRequest;
use App\Http\Requests\PageTemplateUpdateRequest;

class PageTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', PageTemplate::class);

        $search = $request->get('search', '');

        $pageTemplates = PageTemplate::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.page_templates.index',
            compact('pageTemplates', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', PageTemplate::class);

        $pages = Page::pluck('title', 'id');

        return view('app.page_templates.create', compact('pages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PageTemplateStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', PageTemplate::class);

        $validated = $request->validated();

        $pageTemplate = PageTemplate::create($validated);

        return redirect()
            ->route('page-templates.edit', $pageTemplate)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, PageTemplate $pageTemplate): View
    {
        $this->authorize('view', $pageTemplate);

        return view('app.page_templates.show', compact('pageTemplate'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, PageTemplate $pageTemplate): View
    {
        $this->authorize('update', $pageTemplate);

        $pages = Page::pluck('title', 'id');

        return view(
            'app.page_templates.edit',
            compact('pageTemplate', 'pages')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        PageTemplateUpdateRequest $request,
        PageTemplate $pageTemplate
    ): RedirectResponse {
        $this->authorize('update', $pageTemplate);

        $validated = $request->validated();

        $pageTemplate->update($validated);

        return redirect()
            ->route('page-templates.edit', $pageTemplate)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        PageTemplate $pageTemplate
    ): RedirectResponse {
        $this->authorize('delete', $pageTemplate);

        $pageTemplate->delete();

        return redirect()
            ->route('page-templates.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
