<?php

namespace App\Http\Controllers\Api;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\AuthorResource;
use App\Http\Resources\AuthorCollection;
use App\Http\Requests\AuthorStoreRequest;
use App\Http\Requests\AuthorUpdateRequest;

class AuthorController extends Controller
{
    public function index(Request $request): AuthorCollection
    {
        $this->authorize('view-any', Author::class);

        $search = $request->get('search', '');

        $authors = Author::search($search)
            ->latest()
            ->paginate();

        return new AuthorCollection($authors);
    }

    public function store(AuthorStoreRequest $request): AuthorResource
    {
        $this->authorize('create', Author::class);

        $validated = $request->validated();
        $validated['social'] = json_decode($validated['social'], true);

        $author = Author::create($validated);

        return new AuthorResource($author);
    }

    public function show(Request $request, Author $author): AuthorResource
    {
        $this->authorize('view', $author);

        return new AuthorResource($author);
    }

    public function update(
        AuthorUpdateRequest $request,
        Author $author
    ): AuthorResource {
        $this->authorize('update', $author);

        $validated = $request->validated();

        $validated['social'] = json_decode($validated['social'], true);

        $author->update($validated);

        return new AuthorResource($author);
    }

    public function destroy(Request $request, Author $author): Response
    {
        $this->authorize('delete', $author);

        $author->delete();

        return response()->noContent();
    }
}
