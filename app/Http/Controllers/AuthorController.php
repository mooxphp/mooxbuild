<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Author;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\AuthorStoreRequest;
use App\Http\Requests\AuthorUpdateRequest;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Author::class);

        $search = $request->get('search', '');

        $authors = Author::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.authors.index', compact('authors', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Author::class);

        $users = User::pluck('name', 'id');

        return view('app.authors.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AuthorStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Author::class);

        $validated = $request->validated();
        $validated['social'] = json_decode($validated['social'], true);

        $author = Author::create($validated);

        return redirect()
            ->route('authors.edit', $author)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Author $author): View
    {
        $this->authorize('view', $author);

        return view('app.authors.show', compact('author'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Author $author): View
    {
        $this->authorize('update', $author);

        $users = User::pluck('name', 'id');

        return view('app.authors.edit', compact('author', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        AuthorUpdateRequest $request,
        Author $author
    ): RedirectResponse {
        $this->authorize('update', $author);

        $validated = $request->validated();
        $validated['social'] = json_decode($validated['social'], true);

        $author->update($validated);

        return redirect()
            ->route('authors.edit', $author)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Author $author): RedirectResponse
    {
        $this->authorize('delete', $author);

        $author->delete();

        return redirect()
            ->route('authors.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
