<?php

namespace App\Http\Controllers\Api;

use App\Models\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PageTemplateResource;
use App\Http\Resources\PageTemplateCollection;

class PagePageTemplatesController extends Controller
{
    public function index(Request $request, Page $page): PageTemplateCollection
    {
        $this->authorize('view', $page);

        $search = $request->get('search', '');

        $pageTemplates = $page
            ->pageTemplates()
            ->search($search)
            ->latest()
            ->paginate();

        return new PageTemplateCollection($pageTemplates);
    }

    public function store(Request $request, Page $page): PageTemplateResource
    {
        $this->authorize('create', PageTemplate::class);

        $validated = $request->validate([]);

        $pageTemplate = $page->pageTemplates()->create($validated);

        return new PageTemplateResource($pageTemplate);
    }
}
