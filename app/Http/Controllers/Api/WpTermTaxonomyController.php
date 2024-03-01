<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\WpTermTaxonomy;
use App\Http\Controllers\Controller;
use App\Http\Resources\WpTermTaxonomyResource;
use App\Http\Resources\WpTermTaxonomyCollection;
use App\Http\Requests\WpTermTaxonomyStoreRequest;
use App\Http\Requests\WpTermTaxonomyUpdateRequest;

class WpTermTaxonomyController extends Controller
{
    public function index(Request $request): WpTermTaxonomyCollection
    {
        $this->authorize('view-any', WpTermTaxonomy::class);

        $search = $request->get('search', '');

        $wpTermTaxonomies = WpTermTaxonomy::search($search)
            ->latest()
            ->paginate();

        return new WpTermTaxonomyCollection($wpTermTaxonomies);
    }

    public function store(
        WpTermTaxonomyStoreRequest $request
    ): WpTermTaxonomyResource {
        $this->authorize('create', WpTermTaxonomy::class);

        $validated = $request->validated();

        $wpTermTaxonomy = WpTermTaxonomy::create($validated);

        return new WpTermTaxonomyResource($wpTermTaxonomy);
    }

    public function show(
        Request $request,
        WpTermTaxonomy $wpTermTaxonomy
    ): WpTermTaxonomyResource {
        $this->authorize('view', $wpTermTaxonomy);

        return new WpTermTaxonomyResource($wpTermTaxonomy);
    }

    public function update(
        WpTermTaxonomyUpdateRequest $request,
        WpTermTaxonomy $wpTermTaxonomy
    ): WpTermTaxonomyResource {
        $this->authorize('update', $wpTermTaxonomy);

        $validated = $request->validated();

        $wpTermTaxonomy->update($validated);

        return new WpTermTaxonomyResource($wpTermTaxonomy);
    }

    public function destroy(
        Request $request,
        WpTermTaxonomy $wpTermTaxonomy
    ): Response {
        $this->authorize('delete', $wpTermTaxonomy);

        $wpTermTaxonomy->delete();

        return response()->noContent();
    }
}
