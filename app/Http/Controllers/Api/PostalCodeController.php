<?php

namespace App\Http\Controllers\Api;

use App\Models\PostalCode;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostalCodeResource;
use App\Http\Resources\PostalCodeCollection;
use App\Http\Requests\PostalCodeStoreRequest;
use App\Http\Requests\PostalCodeUpdateRequest;

class PostalCodeController extends Controller
{
    public function index(Request $request): PostalCodeCollection
    {
        $this->authorize('view-any', PostalCode::class);

        $search = $request->get('search', '');

        $postalCodes = PostalCode::search($search)
            ->latest()
            ->paginate();

        return new PostalCodeCollection($postalCodes);
    }

    public function store(PostalCodeStoreRequest $request): PostalCodeResource
    {
        $this->authorize('create', PostalCode::class);

        $validated = $request->validated();

        $postalCode = PostalCode::create($validated);

        return new PostalCodeResource($postalCode);
    }

    public function show(
        Request $request,
        PostalCode $postalCode
    ): PostalCodeResource {
        $this->authorize('view', $postalCode);

        return new PostalCodeResource($postalCode);
    }

    public function update(
        PostalCodeUpdateRequest $request,
        PostalCode $postalCode
    ): PostalCodeResource {
        $this->authorize('update', $postalCode);

        $validated = $request->validated();

        $postalCode->update($validated);

        return new PostalCodeResource($postalCode);
    }

    public function destroy(Request $request, PostalCode $postalCode): Response
    {
        $this->authorize('delete', $postalCode);

        $postalCode->delete();

        return response()->noContent();
    }
}
