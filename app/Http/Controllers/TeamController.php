<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\TeamStoreRequest;
use App\Http\Requests\TeamUpdateRequest;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Team::class);

        $search = $request->get('search', '');

        $teams = Team::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.teams.index', compact('teams', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Team::class);

        return view('app.teams.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TeamStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Team::class);

        $validated = $request->validated();

        $team = Team::create($validated);

        return redirect()
            ->route('teams.edit', $team)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Team $team): View
    {
        $this->authorize('view', $team);

        return view('app.teams.show', compact('team'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Team $team): View
    {
        $this->authorize('update', $team);

        return view('app.teams.edit', compact('team'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        TeamUpdateRequest $request,
        Team $team
    ): RedirectResponse {
        $this->authorize('update', $team);

        $validated = $request->validated();

        $team->update($validated);

        return redirect()
            ->route('teams.edit', $team)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Team $team): RedirectResponse
    {
        $this->authorize('delete', $team);

        $team->delete();

        return redirect()
            ->route('teams.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
