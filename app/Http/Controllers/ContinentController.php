<?php

namespace App\Http\Controllers;

use App\Models\Continent;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ContinentStoreRequest;
use App\Http\Requests\ContinentUpdateRequest;

class ContinentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Continent::class);

        $search = $request->get('search', '');

        $continents = Continent::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.continents.index', compact('continents', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Continent::class);

        $continents = Continent::pluck('title', 'id');

        return view('app.continents.create', compact('continents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ContinentStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Continent::class);

        $validated = $request->validated();

        $continent = Continent::create($validated);

        return redirect()
            ->route('continents.edit', $continent)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Continent $continent): View
    {
        $this->authorize('view', $continent);

        return view('app.continents.show', compact('continent'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Continent $continent): View
    {
        $this->authorize('update', $continent);

        $continents = Continent::pluck('title', 'id');

        return view('app.continents.edit', compact('continent', 'continents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        ContinentUpdateRequest $request,
        Continent $continent
    ): RedirectResponse {
        $this->authorize('update', $continent);

        $validated = $request->validated();

        $continent->update($validated);

        return redirect()
            ->route('continents.edit', $continent)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Continent $continent
    ): RedirectResponse {
        $this->authorize('delete', $continent);

        $continent->delete();

        return redirect()
            ->route('continents.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
