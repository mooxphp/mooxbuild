<?php

namespace App\Http\Controllers\Api;

use App\Models\WpPostMeta;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\WpPostMetaResource;
use App\Http\Resources\WpPostMetaCollection;
use App\Http\Requests\WpPostMetaStoreRequest;
use App\Http\Requests\WpPostMetaUpdateRequest;

class WpPostMetaController extends Controller
{
    public function index(Request $request): WpPostMetaCollection
    {
        $this->authorize('view-any', WpPostMeta::class);

        $search = $request->get('search', '');

        $wpPostMetas = WpPostMeta::search($search)
            ->latest()
            ->paginate();

        return new WpPostMetaCollection($wpPostMetas);
    }

    public function store(WpPostMetaStoreRequest $request): WpPostMetaResource
    {
        $this->authorize('create', WpPostMeta::class);

        $validated = $request->validated();

        $wpPostMeta = WpPostMeta::create($validated);

        return new WpPostMetaResource($wpPostMeta);
    }

    public function show(
        Request $request,
        WpPostMeta $wpPostMeta
    ): WpPostMetaResource {
        $this->authorize('view', $wpPostMeta);

        return new WpPostMetaResource($wpPostMeta);
    }

    public function update(
        WpPostMetaUpdateRequest $request,
        WpPostMeta $wpPostMeta
    ): WpPostMetaResource {
        $this->authorize('update', $wpPostMeta);

        $validated = $request->validated();

        $wpPostMeta->update($validated);

        return new WpPostMetaResource($wpPostMeta);
    }

    public function destroy(Request $request, WpPostMeta $wpPostMeta): Response
    {
        $this->authorize('delete', $wpPostMeta);

        $wpPostMeta->delete();

        return response()->noContent();
    }
}
