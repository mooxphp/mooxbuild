<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\WpTermRelationship;
use App\Http\Controllers\Controller;
use App\Http\Resources\WpTermRelationshipResource;
use App\Http\Resources\WpTermRelationshipCollection;
use App\Http\Requests\WpTermRelationshipStoreRequest;
use App\Http\Requests\WpTermRelationshipUpdateRequest;

class WpTermRelationshipController extends Controller
{
    public function index(Request $request): WpTermRelationshipCollection
    {
        $this->authorize('view-any', WpTermRelationship::class);

        $search = $request->get('search', '');

        $wpTermRelationships = WpTermRelationship::search($search)
            ->latest()
            ->paginate();

        return new WpTermRelationshipCollection($wpTermRelationships);
    }

    public function store(
        WpTermRelationshipStoreRequest $request
    ): WpTermRelationshipResource {
        $this->authorize('create', WpTermRelationship::class);

        $validated = $request->validated();

        $wpTermRelationship = WpTermRelationship::create($validated);

        return new WpTermRelationshipResource($wpTermRelationship);
    }

    public function show(
        Request $request,
        WpTermRelationship $wpTermRelationship
    ): WpTermRelationshipResource {
        $this->authorize('view', $wpTermRelationship);

        return new WpTermRelationshipResource($wpTermRelationship);
    }

    public function update(
        WpTermRelationshipUpdateRequest $request,
        WpTermRelationship $wpTermRelationship
    ): WpTermRelationshipResource {
        $this->authorize('update', $wpTermRelationship);

        $validated = $request->validated();

        $wpTermRelationship->update($validated);

        return new WpTermRelationshipResource($wpTermRelationship);
    }

    public function destroy(
        Request $request,
        WpTermRelationship $wpTermRelationship
    ): Response {
        $this->authorize('delete', $wpTermRelationship);

        $wpTermRelationship->delete();

        return response()->noContent();
    }
}
