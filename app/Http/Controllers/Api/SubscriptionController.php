<?php

namespace App\Http\Controllers\Api;

use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\SubscriptionResource;
use App\Http\Resources\SubscriptionCollection;
use App\Http\Requests\SubscriptionStoreRequest;
use App\Http\Requests\SubscriptionUpdateRequest;

class SubscriptionController extends Controller
{
    public function index(Request $request): SubscriptionCollection
    {
        $this->authorize('view-any', Subscription::class);

        $search = $request->get('search', '');

        $subscriptions = Subscription::search($search)
            ->latest()
            ->paginate();

        return new SubscriptionCollection($subscriptions);
    }

    public function store(
        SubscriptionStoreRequest $request
    ): SubscriptionResource {
        $this->authorize('create', Subscription::class);

        $validated = $request->validated();

        $subscription = Subscription::create($validated);

        return new SubscriptionResource($subscription);
    }

    public function show(
        Request $request,
        Subscription $subscription
    ): SubscriptionResource {
        $this->authorize('view', $subscription);

        return new SubscriptionResource($subscription);
    }

    public function update(
        SubscriptionUpdateRequest $request,
        Subscription $subscription
    ): SubscriptionResource {
        $this->authorize('update', $subscription);

        $validated = $request->validated();

        $subscription->update($validated);

        return new SubscriptionResource($subscription);
    }

    public function destroy(
        Request $request,
        Subscription $subscription
    ): Response {
        $this->authorize('delete', $subscription);

        $subscription->delete();

        return response()->noContent();
    }
}
