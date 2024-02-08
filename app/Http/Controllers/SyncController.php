<?php

namespace App\Http\Controllers;

use App\Models\Sync;
use App\Models\Platform;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\SyncStoreRequest;
use App\Http\Requests\SyncUpdateRequest;

class SyncController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Sync::class);

        $search = $request->get('search', '');

        $syncs = Sync::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.syncs.index', compact('syncs', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Sync::class);

        $platforms = Platform::pluck('title', 'id');

        return view('app.syncs.create', compact('platforms', 'platforms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SyncStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Sync::class);

        $validated = $request->validated();

        $sync = Sync::create($validated);

        return redirect()
            ->route('syncs.edit', $sync)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Sync $sync): View
    {
        $this->authorize('view', $sync);

        return view('app.syncs.show', compact('sync'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Sync $sync): View
    {
        $this->authorize('update', $sync);

        $platforms = Platform::pluck('title', 'id');

        return view(
            'app.syncs.edit',
            compact('sync', 'platforms', 'platforms')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        SyncUpdateRequest $request,
        Sync $sync
    ): RedirectResponse {
        $this->authorize('update', $sync);

        $validated = $request->validated();

        $sync->update($validated);

        return redirect()
            ->route('syncs.edit', $sync)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Sync $sync): RedirectResponse
    {
        $this->authorize('delete', $sync);

        $sync->delete();

        return redirect()
            ->route('syncs.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
