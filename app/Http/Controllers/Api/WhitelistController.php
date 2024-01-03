<?php

namespace App\Http\Controllers\Api;

use App\Models\Whitelist;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\WhitelistResource;
use App\Http\Resources\WhitelistCollection;
use App\Http\Requests\WhitelistStoreRequest;
use App\Http\Requests\WhitelistUpdateRequest;

class WhitelistController extends Controller
{
    public function index(Request $request): WhitelistCollection
    {
        $this->authorize('view-any', Whitelist::class);

        $search = $request->get('search', '');

        $whitelists = Whitelist::search($search)
            ->latest()
            ->paginate();

        return new WhitelistCollection($whitelists);
    }

    public function store(WhitelistStoreRequest $request): WhitelistResource
    {
        $this->authorize('create', Whitelist::class);

        $validated = $request->validated();

        $whitelist = Whitelist::create($validated);

        return new WhitelistResource($whitelist);
    }

    public function show(
        Request $request,
        Whitelist $whitelist
    ): WhitelistResource {
        $this->authorize('view', $whitelist);

        return new WhitelistResource($whitelist);
    }

    public function update(
        WhitelistUpdateRequest $request,
        Whitelist $whitelist
    ): WhitelistResource {
        $this->authorize('update', $whitelist);

        $validated = $request->validated();

        $whitelist->update($validated);

        return new WhitelistResource($whitelist);
    }

    public function destroy(Request $request, Whitelist $whitelist): Response
    {
        $this->authorize('delete', $whitelist);

        $whitelist->delete();

        return response()->noContent();
    }
}
