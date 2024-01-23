<?php

namespace App\Http\Controllers\Api;

use App\Models\FirewallRule;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\FirewallRuleResource;
use App\Http\Resources\FirewallRuleCollection;
use App\Http\Requests\FirewallRuleStoreRequest;
use App\Http\Requests\FirewallRuleUpdateRequest;

class FirewallRuleController extends Controller
{
    public function index(Request $request): FirewallRuleCollection
    {
        $this->authorize('view-any', FirewallRule::class);

        $search = $request->get('search', '');

        $firewallRules = FirewallRule::search($search)
            ->latest()
            ->paginate();

        return new FirewallRuleCollection($firewallRules);
    }

    public function store(
        FirewallRuleStoreRequest $request
    ): FirewallRuleResource {
        $this->authorize('create', FirewallRule::class);

        $validated = $request->validated();

        $firewallRule = FirewallRule::create($validated);

        return new FirewallRuleResource($firewallRule);
    }

    public function show(
        Request $request,
        FirewallRule $firewallRule
    ): FirewallRuleResource {
        $this->authorize('view', $firewallRule);

        return new FirewallRuleResource($firewallRule);
    }

    public function update(
        FirewallRuleUpdateRequest $request,
        FirewallRule $firewallRule
    ): FirewallRuleResource {
        $this->authorize('update', $firewallRule);

        $validated = $request->validated();

        $firewallRule->update($validated);

        return new FirewallRuleResource($firewallRule);
    }

    public function destroy(
        Request $request,
        FirewallRule $firewallRule
    ): Response {
        $this->authorize('delete', $firewallRule);

        $firewallRule->delete();

        return response()->noContent();
    }
}
