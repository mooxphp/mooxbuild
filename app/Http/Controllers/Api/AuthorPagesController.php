<?php

namespace App\Http\Controllers\Api;

use App\Models\Author;
use Illuminate\Http\Request;
use App\Http\Resources\PageResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\PageCollection;

class AuthorPagesController extends Controller
{
    public function index(Request $request, Author $author): PageCollection
    {
        $this->authorize('view', $author);

        $search = $request->get('search', '');

        $pages = $author
            ->pages()
            ->search($search)
            ->latest()
            ->paginate();

        return new PageCollection($pages);
    }

    public function store(Request $request, Author $author): PageResource
    {
        $this->authorize('create', Page::class);

        $validated = $request->validate([
            'uid' => ['required', 'max:255'],
            'main_category_id' => ['nullable', 'exists:categories,id'],
            'title' => ['required', 'max:255', 'string'],
            'slug' => ['required', 'max:255', 'string'],
            'short' => ['nullable', 'max:255', 'string'],
            'content' => ['nullable', 'max:255', 'string'],
            'data' => ['nullable', 'max:255', 'json'],
            'image' => ['nullable', 'image', 'max:1024'],
            'thumbnail' => ['nullable', 'file'],
            'language_id' => ['nullable', 'exists:languages,id'],
            'translation_id' => ['nullable', 'exists:pages,id'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request
                ->file('thumbnail')
                ->store('public');
        }

        $page = $author->pages()->create($validated);

        return new PageResource($page);
    }
}
