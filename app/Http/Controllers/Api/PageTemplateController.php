<?php

namespace App\Http\Controllers\Api;

use App\Models\PageTemplate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\PageTemplateResource;
use App\Http\Resources\PageTemplateCollection;
use App\Http\Requests\PageTemplateStoreRequest;
use App\Http\Requests\PageTemplateUpdateRequest;

class PageTemplateController extends Controller
{
    public function index(Request $request): PageTemplateCollection
    {
        $this->authorize('view-any', PageTemplate::class);

        $search = $request->get('search', '');

        $pageTemplates = PageTemplate::search($search)
            ->latest()
            ->paginate();

        return new PageTemplateCollection($pageTemplates);
    }

    public function store(
        PageTemplateStoreRequest $request
    ): PageTemplateResource {
        $this->authorize('create', PageTemplate::class);

        $validated = $request->validated();

        $pageTemplate = PageTemplate::create($validated);

        return new PageTemplateResource($pageTemplate);
    }

    public function show(
        Request $request,
        PageTemplate $pageTemplate
    ): PageTemplateResource {
        $this->authorize('view', $pageTemplate);

        return new PageTemplateResource($pageTemplate);
    }

    public function update(
        PageTemplateUpdateRequest $request,
        PageTemplate $pageTemplate
    ): PageTemplateResource {
        $this->authorize('update', $pageTemplate);

        $validated = $request->validated();

        $pageTemplate->update($validated);

        return new PageTemplateResource($pageTemplate);
    }

    public function destroy(
        Request $request,
        PageTemplate $pageTemplate
    ): Response {
        $this->authorize('delete', $pageTemplate);

        $pageTemplate->delete();

        return response()->noContent();
    }
}
