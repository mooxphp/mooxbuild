<?php

namespace App\Http\Controllers\Api;

use App\Models\Continent;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\ContinentResource;
use App\Http\Resources\ContinentCollection;
use App\Http\Requests\ContinentStoreRequest;
use App\Http\Requests\ContinentUpdateRequest;

class ContinentController extends Controller
{
    public function index(Request $request): ContinentCollection
    {
        $this->authorize('view-any', Continent::class);

        $search = $request->get('search', '');

        $continents = Continent::search($search)
            ->latest()
            ->paginate();

        return new ContinentCollection($continents);
    }

    public function store(ContinentStoreRequest $request): ContinentResource
    {
        $this->authorize('create', Continent::class);

        $validated = $request->validated();

        $continent = Continent::create($validated);

        return new ContinentResource($continent);
    }

    public function show(
        Request $request,
        Continent $continent
    ): ContinentResource {
        $this->authorize('view', $continent);

        return new ContinentResource($continent);
    }

    public function update(
        ContinentUpdateRequest $request,
        Continent $continent
    ): ContinentResource {
        $this->authorize('update', $continent);

        $validated = $request->validated();

        $continent->update($validated);

        return new ContinentResource($continent);
    }

    public function destroy(Request $request, Continent $continent): Response
    {
        $this->authorize('delete', $continent);

        $continent->delete();

        return response()->noContent();
    }
}
