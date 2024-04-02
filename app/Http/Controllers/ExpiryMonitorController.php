<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\ExpiryMonitor;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ExpiryMonitorStoreRequest;
use App\Http\Requests\ExpiryMonitorUpdateRequest;

class ExpiryMonitorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', ExpiryMonitor::class);

        $search = $request->get('search', '');

        $expiryMonitors = ExpiryMonitor::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.expiry_monitors.index',
            compact('expiryMonitors', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', ExpiryMonitor::class);

        return view('app.expiry_monitors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ExpiryMonitorStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', ExpiryMonitor::class);

        $validated = $request->validated();

        $expiryMonitor = ExpiryMonitor::create($validated);

        return redirect()
            ->route('expiry-monitors.edit', $expiryMonitor)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, ExpiryMonitor $expiryMonitor): View
    {
        $this->authorize('view', $expiryMonitor);

        return view('app.expiry_monitors.show', compact('expiryMonitor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, ExpiryMonitor $expiryMonitor): View
    {
        $this->authorize('update', $expiryMonitor);

        return view('app.expiry_monitors.edit', compact('expiryMonitor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        ExpiryMonitorUpdateRequest $request,
        ExpiryMonitor $expiryMonitor
    ): RedirectResponse {
        $this->authorize('update', $expiryMonitor);

        $validated = $request->validated();

        $expiryMonitor->update($validated);

        return redirect()
            ->route('expiry-monitors.edit', $expiryMonitor)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        ExpiryMonitor $expiryMonitor
    ): RedirectResponse {
        $this->authorize('delete', $expiryMonitor);

        $expiryMonitor->delete();

        return redirect()
            ->route('expiry-monitors.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
