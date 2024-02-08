<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\ContentElement;
use App\Http\Controllers\Controller;
use App\Http\Resources\ContentElementResource;
use App\Http\Resources\ContentElementCollection;
use App\Http\Requests\ContentElementStoreRequest;
use App\Http\Requests\ContentElementUpdateRequest;

class ContentElementController extends Controller
{
    public function index(Request $request): ContentElementCollection
    {
        $this->authorize('view-any', ContentElement::class);

        $search = $request->get('search', '');

        $contentElements = ContentElement::search($search)
            ->latest()
            ->paginate();

        return new ContentElementCollection($contentElements);
    }

    public function store(
        ContentElementStoreRequest $request
    ): ContentElementResource {
        $this->authorize('create', ContentElement::class);

        $validated = $request->validated();
        $validated['data_structure'] = json_decode(
            $validated['data_structure'],
            true
        );

        $contentElement = ContentElement::create($validated);

        return new ContentElementResource($contentElement);
    }

    public function show(
        Request $request,
        ContentElement $contentElement
    ): ContentElementResource {
        $this->authorize('view', $contentElement);

        return new ContentElementResource($contentElement);
    }

    public function update(
        ContentElementUpdateRequest $request,
        ContentElement $contentElement
    ): ContentElementResource {
        $this->authorize('update', $contentElement);

        $validated = $request->validated();

        $validated['data_structure'] = json_decode(
            $validated['data_structure'],
            true
        );

        $contentElement->update($validated);

        return new ContentElementResource($contentElement);
    }

    public function destroy(
        Request $request,
        ContentElement $contentElement
    ): Response {
        $this->authorize('delete', $contentElement);

        $contentElement->delete();

        return response()->noContent();
    }
}
