<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AuthorResource;
use App\Http\Resources\AuthorCollection;

class UserAuthorsController extends Controller
{
    public function index(Request $request, User $user): AuthorCollection
    {
        $this->authorize('view', $user);

        $search = $request->get('search', '');

        $authors = $user
            ->authors()
            ->search($search)
            ->latest()
            ->paginate();

        return new AuthorCollection($authors);
    }

    public function store(Request $request, User $user): AuthorResource
    {
        $this->authorize('create', Author::class);

        $validated = $request->validate([
            'salutation' => ['nullable', 'max:255', 'string'],
            'title' => ['nullable', 'max:255', 'string'],
            'name' => ['required', 'max:255', 'string'],
            'full_name' => ['nullable', 'max:255', 'string'],
            'first_name' => ['nullable', 'max:255', 'string'],
            'last_name' => ['nullable', 'max:255', 'string'],
            'mail_address' => ['required', 'max:255', 'string'],
            'website' => ['nullable', 'max:255', 'string'],
            'address' => ['nullable', 'max:255', 'string'],
            'social' => ['nullable', 'max:255', 'json'],
            'published_at' => ['nullable', 'date'],
        ]);

        $author = $user->authors()->create($validated);

        return new AuthorResource($author);
    }
}
