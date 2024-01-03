<?php

namespace App\Http\Controllers;

use App\Models\Whitelist;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\WhitelistStoreRequest;
use App\Http\Requests\WhitelistUpdateRequest;

class WhitelistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Whitelist::class);

        $search = $request->get('search', '');

        $whitelists = Whitelist::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.whitelists.index', compact('whitelists', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Whitelist::class);

        return view('app.whitelists.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WhitelistStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Whitelist::class);

        $validated = $request->validated();

        $whitelist = Whitelist::create($validated);

        return redirect()
            ->route('whitelists.edit', $whitelist)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Whitelist $whitelist): View
    {
        $this->authorize('view', $whitelist);

        return view('app.whitelists.show', compact('whitelist'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Whitelist $whitelist): View
    {
        $this->authorize('update', $whitelist);

        return view('app.whitelists.edit', compact('whitelist'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        WhitelistUpdateRequest $request,
        Whitelist $whitelist
    ): RedirectResponse {
        $this->authorize('update', $whitelist);

        $validated = $request->validated();

        $whitelist->update($validated);

        return redirect()
            ->route('whitelists.edit', $whitelist)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Whitelist $whitelist
    ): RedirectResponse {
        $this->authorize('delete', $whitelist);

        $whitelist->delete();

        return redirect()
            ->route('whitelists.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
