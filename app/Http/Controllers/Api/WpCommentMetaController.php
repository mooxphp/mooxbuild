<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\WpCommentMeta;
use App\Http\Controllers\Controller;
use App\Http\Resources\WpCommentMetaResource;
use App\Http\Resources\WpCommentMetaCollection;
use App\Http\Requests\WpCommentMetaStoreRequest;
use App\Http\Requests\WpCommentMetaUpdateRequest;

class WpCommentMetaController extends Controller
{
    public function index(Request $request): WpCommentMetaCollection
    {
        $this->authorize('view-any', WpCommentMeta::class);

        $search = $request->get('search', '');

        $wpCommentMetas = WpCommentMeta::search($search)
            ->latest()
            ->paginate();

        return new WpCommentMetaCollection($wpCommentMetas);
    }

    public function store(
        WpCommentMetaStoreRequest $request
    ): WpCommentMetaResource {
        $this->authorize('create', WpCommentMeta::class);

        $validated = $request->validated();

        $wpCommentMeta = WpCommentMeta::create($validated);

        return new WpCommentMetaResource($wpCommentMeta);
    }

    public function show(
        Request $request,
        WpCommentMeta $wpCommentMeta
    ): WpCommentMetaResource {
        $this->authorize('view', $wpCommentMeta);

        return new WpCommentMetaResource($wpCommentMeta);
    }

    public function update(
        WpCommentMetaUpdateRequest $request,
        WpCommentMeta $wpCommentMeta
    ): WpCommentMetaResource {
        $this->authorize('update', $wpCommentMeta);

        $validated = $request->validated();

        $wpCommentMeta->update($validated);

        return new WpCommentMetaResource($wpCommentMeta);
    }

    public function destroy(
        Request $request,
        WpCommentMeta $wpCommentMeta
    ): Response {
        $this->authorize('delete', $wpCommentMeta);

        $wpCommentMeta->delete();

        return response()->noContent();
    }
}
