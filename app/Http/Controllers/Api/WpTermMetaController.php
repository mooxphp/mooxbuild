<?php

namespace App\Http\Controllers\Api;

use App\Models\WpTermMeta;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\WpTermMetaResource;
use App\Http\Resources\WpTermMetaCollection;
use App\Http\Requests\WpTermMetaStoreRequest;
use App\Http\Requests\WpTermMetaUpdateRequest;

class WpTermMetaController extends Controller
{
    public function index(Request $request): WpTermMetaCollection
    {
        $this->authorize('view-any', WpTermMeta::class);

        $search = $request->get('search', '');

        $wpTermMetas = WpTermMeta::search($search)
            ->latest()
            ->paginate();

        return new WpTermMetaCollection($wpTermMetas);
    }

    public function store(WpTermMetaStoreRequest $request): WpTermMetaResource
    {
        $this->authorize('create', WpTermMeta::class);

        $validated = $request->validated();

        $wpTermMeta = WpTermMeta::create($validated);

        return new WpTermMetaResource($wpTermMeta);
    }

    public function show(
        Request $request,
        WpTermMeta $wpTermMeta
    ): WpTermMetaResource {
        $this->authorize('view', $wpTermMeta);

        return new WpTermMetaResource($wpTermMeta);
    }

    public function update(
        WpTermMetaUpdateRequest $request,
        WpTermMeta $wpTermMeta
    ): WpTermMetaResource {
        $this->authorize('update', $wpTermMeta);

        $validated = $request->validated();

        $wpTermMeta->update($validated);

        return new WpTermMetaResource($wpTermMeta);
    }

    public function destroy(Request $request, WpTermMeta $wpTermMeta): Response
    {
        $this->authorize('delete', $wpTermMeta);

        $wpTermMeta->delete();

        return response()->noContent();
    }
}
