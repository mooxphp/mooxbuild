<?php

namespace App\Http\Controllers\Api;

use App\Models\Blacklist;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\BlacklistResource;
use App\Http\Resources\BlacklistCollection;
use App\Http\Requests\BlacklistStoreRequest;
use App\Http\Requests\BlacklistUpdateRequest;

class BlacklistController extends Controller
{
    public function index(Request $request): BlacklistCollection
    {
        $this->authorize('view-any', Blacklist::class);

        $search = $request->get('search', '');

        $blacklists = Blacklist::search($search)
            ->latest()
            ->paginate();

        return new BlacklistCollection($blacklists);
    }

    public function store(BlacklistStoreRequest $request): BlacklistResource
    {
        $this->authorize('create', Blacklist::class);

        $validated = $request->validated();

        $blacklist = Blacklist::create($validated);

        return new BlacklistResource($blacklist);
    }

    public function show(
        Request $request,
        Blacklist $blacklist
    ): BlacklistResource {
        $this->authorize('view', $blacklist);

        return new BlacklistResource($blacklist);
    }

    public function update(
        BlacklistUpdateRequest $request,
        Blacklist $blacklist
    ): BlacklistResource {
        $this->authorize('update', $blacklist);

        $validated = $request->validated();

        $blacklist->update($validated);

        return new BlacklistResource($blacklist);
    }

    public function destroy(Request $request, Blacklist $blacklist): Response
    {
        $this->authorize('delete', $blacklist);

        $blacklist->delete();

        return response()->noContent();
    }
}
