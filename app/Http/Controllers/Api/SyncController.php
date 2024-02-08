<?php

namespace App\Http\Controllers\Api;

use App\Models\Sync;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\SyncResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\SyncCollection;
use App\Http\Requests\SyncStoreRequest;
use App\Http\Requests\SyncUpdateRequest;

class SyncController extends Controller
{
    public function index(Request $request): SyncCollection
    {
        $this->authorize('view-any', Sync::class);

        $search = $request->get('search', '');

        $syncs = Sync::search($search)
            ->latest()
            ->paginate();

        return new SyncCollection($syncs);
    }

    public function store(SyncStoreRequest $request): SyncResource
    {
        $this->authorize('create', Sync::class);

        $validated = $request->validated();

        $sync = Sync::create($validated);

        return new SyncResource($sync);
    }

    public function show(Request $request, Sync $sync): SyncResource
    {
        $this->authorize('view', $sync);

        return new SyncResource($sync);
    }

    public function update(SyncUpdateRequest $request, Sync $sync): SyncResource
    {
        $this->authorize('update', $sync);

        $validated = $request->validated();

        $sync->update($validated);

        return new SyncResource($sync);
    }

    public function destroy(Request $request, Sync $sync): Response
    {
        $this->authorize('delete', $sync);

        $sync->delete();

        return response()->noContent();
    }
}
