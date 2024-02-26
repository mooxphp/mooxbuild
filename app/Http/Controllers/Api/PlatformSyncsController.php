<?php

namespace App\Http\Controllers\Api;

use App\Models\Platform;
use Illuminate\Http\Request;
use App\Http\Resources\SyncResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\SyncCollection;

class PlatformSyncsController extends Controller
{
    public function index(Request $request, Platform $platform): SyncCollection
    {
        $this->authorize('view', $platform);

        $search = $request->get('search', '');

        $syncs = $platform
            ->targets()
            ->search($search)
            ->latest()
            ->paginate();

        return new SyncCollection($syncs);
    }

    public function store(Request $request, Platform $platform): SyncResource
    {
        $this->authorize('create', Sync::class);

        $validated = $request->validate([
            'syncable_id' => ['required', 'max:255'],
            'syncable_type' => ['required', 'max:255', 'string'],
            'last_sync' => ['required', 'date'],
        ]);

        $sync = $platform->targets()->create($validated);

        return new SyncResource($sync);
    }
}
