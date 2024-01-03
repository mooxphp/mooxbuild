<?php

namespace App\Http\Controllers\Api;

use App\Models\BypassToken;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\BypassTokenResource;
use App\Http\Resources\BypassTokenCollection;
use App\Http\Requests\BypassTokenStoreRequest;
use App\Http\Requests\BypassTokenUpdateRequest;

class BypassTokenController extends Controller
{
    public function index(Request $request): BypassTokenCollection
    {
        $this->authorize('view-any', BypassToken::class);

        $search = $request->get('search', '');

        $bypassTokens = BypassToken::search($search)
            ->latest()
            ->paginate();

        return new BypassTokenCollection($bypassTokens);
    }

    public function store(BypassTokenStoreRequest $request): BypassTokenResource
    {
        $this->authorize('create', BypassToken::class);

        $validated = $request->validated();

        $bypassToken = BypassToken::create($validated);

        return new BypassTokenResource($bypassToken);
    }

    public function show(
        Request $request,
        BypassToken $bypassToken
    ): BypassTokenResource {
        $this->authorize('view', $bypassToken);

        return new BypassTokenResource($bypassToken);
    }

    public function update(
        BypassTokenUpdateRequest $request,
        BypassToken $bypassToken
    ): BypassTokenResource {
        $this->authorize('update', $bypassToken);

        $validated = $request->validated();

        $bypassToken->update($validated);

        return new BypassTokenResource($bypassToken);
    }

    public function destroy(
        Request $request,
        BypassToken $bypassToken
    ): Response {
        $this->authorize('delete', $bypassToken);

        $bypassToken->delete();

        return response()->noContent();
    }
}
