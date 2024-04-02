<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\ExpiryMonitor;
use App\Http\Controllers\Controller;
use App\Http\Resources\ExpiryResource;
use App\Http\Resources\ExpiryCollection;

class ExpiryMonitorExpiriesController extends Controller
{
    public function index(
        Request $request,
        ExpiryMonitor $expiryMonitor
    ): ExpiryCollection {
        $this->authorize('view', $expiryMonitor);

        $search = $request->get('search', '');

        $expiries = $expiryMonitor
            ->expiries()
            ->search($search)
            ->latest()
            ->paginate();

        return new ExpiryCollection($expiries);
    }

    public function store(
        Request $request,
        ExpiryMonitor $expiryMonitor
    ): ExpiryResource {
        $this->authorize('create', Expiry::class);

        $validated = $request->validate([
            'title' => ['required', 'max:255', 'string'],
            'slug' => ['required', 'max:255', 'string'],
            'item' => ['required', 'max:255', 'string'],
            'link' => ['required', 'max:255', 'string'],
            'expired_at' => ['required', 'date'],
            'notified_at' => ['required', 'date'],
            'notified_to' => ['required', 'max:255', 'string'],
            'escalated_at' => ['required', 'date'],
            'escalated_to' => ['required', 'max:255', 'string'],
            'handled_by' => ['required', 'max:255', 'string'],
            'done_at' => ['required', 'date'],
        ]);

        $expiry = $expiryMonitor->expiries()->create($validated);

        return new ExpiryResource($expiry);
    }
}
