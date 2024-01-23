<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\FirewallRule;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\FirewallRuleStoreRequest;
use App\Http\Requests\FirewallRuleUpdateRequest;

class FirewallRuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', FirewallRule::class);

        $search = $request->get('search', '');

        $firewallRules = FirewallRule::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.firewall_rules.index',
            compact('firewallRules', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', FirewallRule::class);

        return view('app.firewall_rules.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FirewallRuleStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', FirewallRule::class);

        $validated = $request->validated();

        $firewallRule = FirewallRule::create($validated);

        return redirect()
            ->route('firewall-rules.edit', $firewallRule)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, FirewallRule $firewallRule): View
    {
        $this->authorize('view', $firewallRule);

        return view('app.firewall_rules.show', compact('firewallRule'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, FirewallRule $firewallRule): View
    {
        $this->authorize('update', $firewallRule);

        return view('app.firewall_rules.edit', compact('firewallRule'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        FirewallRuleUpdateRequest $request,
        FirewallRule $firewallRule
    ): RedirectResponse {
        $this->authorize('update', $firewallRule);

        $validated = $request->validated();

        $firewallRule->update($validated);

        return redirect()
            ->route('firewall-rules.edit', $firewallRule)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        FirewallRule $firewallRule
    ): RedirectResponse {
        $this->authorize('delete', $firewallRule);

        $firewallRule->delete();

        return redirect()
            ->route('firewall-rules.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
