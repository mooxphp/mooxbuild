<?php

namespace App\Http\Controllers\Api;

use App\Models\WpUserMeta;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\WpUserMetaResource;
use App\Http\Resources\WpUserMetaCollection;
use App\Http\Requests\WpUserMetaStoreRequest;
use App\Http\Requests\WpUserMetaUpdateRequest;

class WpUserMetaController extends Controller
{
    public function index(Request $request): WpUserMetaCollection
    {
        $this->authorize('view-any', WpUserMeta::class);

        $search = $request->get('search', '');

        $wpUserMetas = WpUserMeta::search($search)
            ->latest()
            ->paginate();

        return new WpUserMetaCollection($wpUserMetas);
    }

    public function store(WpUserMetaStoreRequest $request): WpUserMetaResource
    {
        $this->authorize('create', WpUserMeta::class);

        $validated = $request->validated();

        $wpUserMeta = WpUserMeta::create($validated);

        return new WpUserMetaResource($wpUserMeta);
    }

    public function show(
        Request $request,
        WpUserMeta $wpUserMeta
    ): WpUserMetaResource {
        $this->authorize('view', $wpUserMeta);

        return new WpUserMetaResource($wpUserMeta);
    }

    public function update(
        WpUserMetaUpdateRequest $request,
        WpUserMeta $wpUserMeta
    ): WpUserMetaResource {
        $this->authorize('update', $wpUserMeta);

        $validated = $request->validated();

        $wpUserMeta->update($validated);

        return new WpUserMetaResource($wpUserMeta);
    }

    public function destroy(Request $request, WpUserMeta $wpUserMeta): Response
    {
        $this->authorize('delete', $wpUserMeta);

        $wpUserMeta->delete();

        return response()->noContent();
    }
}
