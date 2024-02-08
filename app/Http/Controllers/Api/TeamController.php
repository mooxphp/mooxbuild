<?php

namespace App\Http\Controllers\Api;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\TeamResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\TeamCollection;
use App\Http\Requests\TeamStoreRequest;
use App\Http\Requests\TeamUpdateRequest;

class TeamController extends Controller
{
    public function index(Request $request): TeamCollection
    {
        $this->authorize('view-any', Team::class);

        $search = $request->get('search', '');

        $teams = Team::search($search)
            ->latest()
            ->paginate();

        return new TeamCollection($teams);
    }

    public function store(TeamStoreRequest $request): TeamResource
    {
        $this->authorize('create', Team::class);

        $validated = $request->validated();

        $team = Team::create($validated);

        return new TeamResource($team);
    }

    public function show(Request $request, Team $team): TeamResource
    {
        $this->authorize('view', $team);

        return new TeamResource($team);
    }

    public function update(TeamUpdateRequest $request, Team $team): TeamResource
    {
        $this->authorize('update', $team);

        $validated = $request->validated();

        $team->update($validated);

        return new TeamResource($team);
    }

    public function destroy(Request $request, Team $team): Response
    {
        $this->authorize('delete', $team);

        $team->delete();

        return response()->noContent();
    }
}
