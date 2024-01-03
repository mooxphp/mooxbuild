<?php

namespace App\Http\Controllers;

use App\Models\Blacklist;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\BlacklistStoreRequest;
use App\Http\Requests\BlacklistUpdateRequest;

class BlacklistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Blacklist::class);

        $search = $request->get('search', '');

        $blacklists = Blacklist::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.blacklists.index', compact('blacklists', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Blacklist::class);

        return view('app.blacklists.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlacklistStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Blacklist::class);

        $validated = $request->validated();

        $blacklist = Blacklist::create($validated);

        return redirect()
            ->route('blacklists.edit', $blacklist)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Blacklist $blacklist): View
    {
        $this->authorize('view', $blacklist);

        return view('app.blacklists.show', compact('blacklist'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Blacklist $blacklist): View
    {
        $this->authorize('update', $blacklist);

        return view('app.blacklists.edit', compact('blacklist'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        BlacklistUpdateRequest $request,
        Blacklist $blacklist
    ): RedirectResponse {
        $this->authorize('update', $blacklist);

        $validated = $request->validated();

        $blacklist->update($validated);

        return redirect()
            ->route('blacklists.edit', $blacklist)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Blacklist $blacklist
    ): RedirectResponse {
        $this->authorize('delete', $blacklist);

        $blacklist->delete();

        return redirect()
            ->route('blacklists.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
