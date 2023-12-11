<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Comment;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CommentStoreRequest;
use App\Http\Requests\CommentUpdateRequest;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Comment::class);

        $search = $request->get('search', '');

        $comments = Comment::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.comments.index', compact('comments', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Comment::class);

        $comments = Comment::pluck('title', 'id');
        $authors = Author::pluck('title', 'id');

        return view('app.comments.create', compact('comments', 'authors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CommentStoreRequest $request): RedirectResponse
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

        return redirect()
            ->route('comments.edit', $comment)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Comment $comment): View
    {
        $this->authorize('view', $comment);

        return view('app.comments.show', compact('comment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Comment $comment): View
    {
        $this->authorize('update', $comment);

        $comments = Comment::pluck('title', 'id');
        $authors = Author::pluck('title', 'id');

        return view(
            'app.comments.edit',
            compact('comment', 'comments', 'authors')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        CommentUpdateRequest $request,
        Comment $comment
    ): RedirectResponse {
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

        return redirect()
            ->route('comments.edit', $comment)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Comment $comment
    ): RedirectResponse {
        $this->authorize('delete', $comment);

        if ($comment->avatar) {
            Storage::delete($comment->avatar);
        }

        $comment->delete();

        return redirect()
            ->route('comments.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
