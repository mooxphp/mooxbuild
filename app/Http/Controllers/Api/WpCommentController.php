<?php

namespace App\Http\Controllers\Api;

use App\Models\WpComment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\WpCommentResource;
use App\Http\Resources\WpCommentCollection;
use App\Http\Requests\WpCommentStoreRequest;
use App\Http\Requests\WpCommentUpdateRequest;

class WpCommentController extends Controller
{
    public function index(Request $request): WpCommentCollection
    {
        $this->authorize('view-any', WpComment::class);

        $search = $request->get('search', '');

        $wpComments = WpComment::search($search)
            ->latest()
            ->paginate();

        return new WpCommentCollection($wpComments);
    }

    public function store(WpCommentStoreRequest $request): WpCommentResource
    {
        $this->authorize('create', WpComment::class);

        $validated = $request->validated();

        $wpComment = WpComment::create($validated);

        return new WpCommentResource($wpComment);
    }

    public function show(
        Request $request,
        WpComment $wpComment
    ): WpCommentResource {
        $this->authorize('view', $wpComment);

        return new WpCommentResource($wpComment);
    }

    public function update(
        WpCommentUpdateRequest $request,
        WpComment $wpComment
    ): WpCommentResource {
        $this->authorize('update', $wpComment);

        $validated = $request->validated();

        $wpComment->update($validated);

        return new WpCommentResource($wpComment);
    }

    public function destroy(Request $request, WpComment $wpComment): Response
    {
        $this->authorize('delete', $wpComment);

        $wpComment->delete();

        return response()->noContent();
    }
}
