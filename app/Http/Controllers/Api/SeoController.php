<?php

namespace App\Http\Controllers\Api;

use App\Models\Seo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\SeoResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\SeoCollection;
use App\Http\Requests\SeoStoreRequest;
use App\Http\Requests\SeoUpdateRequest;

class SeoController extends Controller
{
    public function index(Request $request): SeoCollection
    {
        $this->authorize('view-any', Seo::class);

        $search = $request->get('search', '');

        $seos = Seo::search($search)
            ->latest()
            ->paginate();

        return new SeoCollection($seos);
    }

    public function store(SeoStoreRequest $request): SeoResource
    {
        $this->authorize('create', Seo::class);

        $validated = $request->validated();
        $validated['schema_markup'] = json_decode(
            $validated['schema_markup'],
            true
        );

        $validated['focus_keyphrases'] = json_decode(
            $validated['focus_keyphrases'],
            true
        );

        $validated['seo_scores'] = json_decode($validated['seo_scores'], true);

        $validated['web_manifest'] = json_decode(
            $validated['web_manifest'],
            true
        );

        $seo = Seo::create($validated);

        return new SeoResource($seo);
    }

    public function show(Request $request, Seo $seo): SeoResource
    {
        $this->authorize('view', $seo);

        return new SeoResource($seo);
    }

    public function update(SeoUpdateRequest $request, Seo $seo): SeoResource
    {
        $this->authorize('update', $seo);

        $validated = $request->validated();

        $validated['schema_markup'] = json_decode(
            $validated['schema_markup'],
            true
        );

        $validated['focus_keyphrases'] = json_decode(
            $validated['focus_keyphrases'],
            true
        );

        $validated['seo_scores'] = json_decode($validated['seo_scores'], true);

        $validated['web_manifest'] = json_decode(
            $validated['web_manifest'],
            true
        );

        $seo->update($validated);

        return new SeoResource($seo);
    }

    public function destroy(Request $request, Seo $seo): Response
    {
        $this->authorize('delete', $seo);

        $seo->delete();

        return response()->noContent();
    }
}
