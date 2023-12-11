<?php

namespace App\Http\Controllers\Api;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\CommentCollection;
use App\Http\Requests\CommentStoreRequest;
use App\Http\Requests\CommentUpdateRequest;

class CommentController extends Controller
{
    public function index(Request $request): CommentCollection
    {
        $this->authorize('view-any', Comment::class);

        $search = $request->get('search', '');

        $comments = Comment::search($search)
            ->latest()
            ->paginate();

        return new CommentCollection($comments);
    }

    public function store(CommentStoreRequest $request): CommentResource
    {
        $this->authorize('create', Comment::class);

        $validated = $request->validated();
        if ($request->hasFile('avatar')) {
            $validated['avatar'] = $request->file('avatar')->store('public');
        }

        $validated['translations'] = json_decode(
            $validated['translations'],
            true
        );

        $comment = Comment::create($validated);

        return new CommentResource($comment);
    }

    public function show(Request $request, Comment $comment): CommentResource
    {
        $this->authorize('view', $comment);

        return new CommentResource($comment);
    }

    public function update(
        CommentUpdateRequest $request,
        Comment $comment
    ): CommentResource {
        $this->authorize('update', $comment);

        $validated = $request->validated();

        if ($request->hasFile('avatar')) {
            if ($comment->avatar) {
                Storage::delete($comment->avatar);
            }

            $validated['avatar'] = $request->file('avatar')->store('public');
        }

        $validated['translations'] = json_decode(
            $validated['translations'],
            true
        );

        $comment->update($validated);

        return new CommentResource($comment);
    }

    public function destroy(Request $request, Comment $comment): Response
    {
        $this->authorize('delete', $comment);

        if ($comment->avatar) {
            Storage::delete($comment->avatar);
        }

        $comment->delete();

        return response()->noContent();
    }
}
