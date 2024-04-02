<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\ExpiryMonitor;
use App\Http\Controllers\Controller;
use App\Http\Resources\ExpiryMonitorResource;
use App\Http\Resources\ExpiryMonitorCollection;
use App\Http\Requests\ExpiryMonitorStoreRequest;
use App\Http\Requests\ExpiryMonitorUpdateRequest;

class ExpiryMonitorController extends Controller
{
    public function index(Request $request): ExpiryMonitorCollection
    {
        $this->authorize('view-any', ExpiryMonitor::class);

        $search = $request->get('search', '');

        $expiryMonitors = ExpiryMonitor::search($search)
            ->latest()
            ->paginate();

        return new ExpiryMonitorCollection($expiryMonitors);
    }

    public function store(
        ExpiryMonitorStoreRequest $request
    ): ExpiryMonitorResource {
        $this->authorize('create', ExpiryMonitor::class);

        $validated = $request->validated();

        $expiryMonitor = ExpiryMonitor::create($validated);

        return new ExpiryMonitorResource($expiryMonitor);
    }

    public function show(
        Request $request,
        ExpiryMonitor $expiryMonitor
    ): ExpiryMonitorResource {
        $this->authorize('view', $expiryMonitor);

        return new ExpiryMonitorResource($expiryMonitor);
    }

    public function update(
        ExpiryMonitorUpdateRequest $request,
        ExpiryMonitor $expiryMonitor
    ): ExpiryMonitorResource {
        $this->authorize('update', $expiryMonitor);

        $validated = $request->validated();

        $expiryMonitor->update($validated);

        return new ExpiryMonitorResource($expiryMonitor);
    }

    public function destroy(
        Request $request,
        ExpiryMonitor $expiryMonitor
    ): Response {
        $this->authorize('delete', $expiryMonitor);

        $expiryMonitor->delete();

        return response()->noContent();
    }
}
