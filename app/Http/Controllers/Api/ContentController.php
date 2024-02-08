<?php

namespace App\Http\Controllers\Api;

use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\ContentResource;
use App\Http\Resources\ContentCollection;
use App\Http\Requests\ContentStoreRequest;
use App\Http\Requests\ContentUpdateRequest;

class ContentController extends Controller
{
    public function index(Request $request): ContentCollection
    {
        $this->authorize('view-any', Content::class);

        $search = $request->get('search', '');

        $contents = Content::search($search)
            ->latest()
            ->paginate();

        return new ContentCollection($contents);
    }

    public function store(ContentStoreRequest $request): ContentResource
    {
        $this->authorize('create', Content::class);

        $validated = $request->validated();
        $validated['data'] = json_decode($validated['data'], true);

        $validated['settings'] = json_decode($validated['settings'], true);

        $content = Content::create($validated);

        return new ContentResource($content);
    }

    public function show(Request $request, Content $content): ContentResource
    {
        $this->authorize('view', $content);

        return new ContentResource($content);
    }

    public function update(
        ContentUpdateRequest $request,
        Content $content
    ): ContentResource {
        $this->authorize('update', $content);

        $validated = $request->validated();

        $validated['data'] = json_decode($validated['data'], true);

        $validated['settings'] = json_decode($validated['settings'], true);

        $content->update($validated);

        return new ContentResource($content);
    }

    public function destroy(Request $request, Content $content): Response
    {
        $this->authorize('delete', $content);

        $content->delete();

        return response()->noContent();
    }
}
