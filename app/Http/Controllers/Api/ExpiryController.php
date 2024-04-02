<?php

namespace App\Http\Controllers\Api;

use App\Models\Expiry;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\ExpiryResource;
use App\Http\Resources\ExpiryCollection;
use App\Http\Requests\ExpiryStoreRequest;
use App\Http\Requests\ExpiryUpdateRequest;

class ExpiryController extends Controller
{
    public function index(Request $request): ExpiryCollection
    {
        $this->authorize('view-any', Expiry::class);

        $search = $request->get('search', '');

        $expiries = Expiry::search($search)
            ->latest()
            ->paginate();

        return new ExpiryCollection($expiries);
    }

    public function store(ExpiryStoreRequest $request): ExpiryResource
    {
        $this->authorize('create', Expiry::class);

        $validated = $request->validated();

        $expiry = Expiry::create($validated);

        return new ExpiryResource($expiry);
    }

    public function show(Request $request, Expiry $expiry): ExpiryResource
    {
        $this->authorize('view', $expiry);

        return new ExpiryResource($expiry);
    }

    public function update(
        ExpiryUpdateRequest $request,
        Expiry $expiry
    ): ExpiryResource {
        $this->authorize('update', $expiry);

        $validated = $request->validated();

        $expiry->update($validated);

        return new ExpiryResource($expiry);
    }

    public function destroy(Request $request, Expiry $expiry): Response
    {
        $this->authorize('delete', $expiry);

        $expiry->delete();

        return response()->noContent();
    }
}
