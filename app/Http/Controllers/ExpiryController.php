<?php

namespace App\Http\Controllers;

use App\Models\Expiry;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\ExpiryMonitor;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ExpiryStoreRequest;
use App\Http\Requests\ExpiryUpdateRequest;

class ExpiryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Expiry::class);

        $search = $request->get('search', '');

        $expiries = Expiry::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.expiries.index', compact('expiries', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Expiry::class);

        $expiryMonitors = ExpiryMonitor::pluck('title', 'id');

        return view('app.expiries.create', compact('expiryMonitors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ExpiryStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Expiry::class);

        $validated = $request->validated();

        $expiry = Expiry::create($validated);

        return redirect()
            ->route('expiries.edit', $expiry)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Expiry $expiry): View
    {
        $this->authorize('view', $expiry);

        return view('app.expiries.show', compact('expiry'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Expiry $expiry): View
    {
        $this->authorize('update', $expiry);

        $expiryMonitors = ExpiryMonitor::pluck('title', 'id');

        return view('app.expiries.edit', compact('expiry', 'expiryMonitors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        ExpiryUpdateRequest $request,
        Expiry $expiry
    ): RedirectResponse {
        $this->authorize('update', $expiry);

        $validated = $request->validated();

        $expiry->update($validated);

        return redirect()
            ->route('expiries.edit', $expiry)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Expiry $expiry): RedirectResponse
    {
        $this->authorize('delete', $expiry);

        $expiry->delete();

        return redirect()
            ->route('expiries.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
