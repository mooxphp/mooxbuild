<?php

namespace App\Http\Controllers\Api;

use App\Models\Author;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Http\Resources\CommentCollection;

class AuthorCommentsController extends Controller
{
    public function index(Request $request, Author $author): CommentCollection
    {
        $this->authorize('view', $author);

        $search = $request->get('search', '');

        $comments = $author
            ->comments()
            ->search($search)
            ->latest()
            ->paginate();

        return new CommentCollection($comments);
    }

    public function store(Request $request, Author $author): CommentResource
    {
        $this->authorize('create', Comment::class);

        $validated = $request->validate([
            'title' => ['required', 'max:255', 'string'],
            'slug' => ['required', 'max:255', 'string'],
            'content' => ['required', 'max:255', 'string'],
            'translations' => ['required', 'max:255', 'json'],
            'parent_id' => ['nullable', 'exists:comments,id'],
            'is_from_author' => ['nullable', 'boolean'],
            'name' => ['required', 'max:255', 'string'],
            'email' => ['required', 'email'],
            'avatar' => ['nullable', 'file'],
        ]);

        if ($request->hasFile('avatar')) {
            $validated['avatar'] = $request->file('avatar')->store('public');
        }

        $comment = $author->comments()->create($validated);

        return new CommentResource($comment);
    }
}
