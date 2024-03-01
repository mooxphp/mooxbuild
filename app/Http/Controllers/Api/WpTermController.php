<?php

namespace App\Http\Controllers\Api;

use App\Models\WpTerm;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\WpTermResource;
use App\Http\Resources\WpTermCollection;
use App\Http\Requests\WpTermStoreRequest;
use App\Http\Requests\WpTermUpdateRequest;

class WpTermController extends Controller
{
    public function index(Request $request): WpTermCollection
    {
        $this->authorize('view-any', WpTerm::class);

        $search = $request->get('search', '');

        $wpTerms = WpTerm::search($search)
            ->latest()
            ->paginate();

        return new WpTermCollection($wpTerms);
    }

    public function store(WpTermStoreRequest $request): WpTermResource
    {
        $this->authorize('create', WpTerm::class);

        $validated = $request->validated();

        $wpTerm = WpTerm::create($validated);

        return new WpTermResource($wpTerm);
    }

    public function show(Request $request, WpTerm $wpTerm): WpTermResource
    {
        $this->authorize('view', $wpTerm);

        return new WpTermResource($wpTerm);
    }

    public function update(
        WpTermUpdateRequest $request,
        WpTerm $wpTerm
    ): WpTermResource {
        $this->authorize('update', $wpTerm);

        $validated = $request->validated();

        $wpTerm->update($validated);

        return new WpTermResource($wpTerm);
    }

    public function destroy(Request $request, WpTerm $wpTerm): Response
    {
        $this->authorize('delete', $wpTerm);

        $wpTerm->delete();

        return response()->noContent();
    }
}
