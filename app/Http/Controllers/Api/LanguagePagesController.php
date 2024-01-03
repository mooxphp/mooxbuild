<?php

namespace App\Http\Controllers\Api;

use App\Models\Language;
use Illuminate\Http\Request;
use App\Http\Resources\PageResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\PageCollection;

class LanguagePagesController extends Controller
{
    public function index(Request $request, Language $language): PageCollection
    {
        $this->authorize('view', $language);

        $search = $request->get('search', '');

        $pages = $language
            ->pages()
            ->search($search)
            ->latest()
            ->paginate();

        return new PageCollection($pages);
    }

    public function store(Request $request, Language $language): PageResource
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
            'author_id' => ['required', 'exists:authors,id'],
            'created_by_user_id' => ['required', 'max:255', 'string'],
            'created_by_user_name' => ['required', 'max:255', 'string'],
            'edited_by_user_id' => ['required', 'max:255', 'string'],
            'edited_by_user_name' => ['required', 'max:255', 'string'],
            'translation_id' => ['nullable', 'exists:pages,id'],
            'published_at' => ['nullable', 'date'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request
                ->file('thumbnail')
                ->store('public');
        }

        $page = $language->pages()->create($validated);

        return new PageResource($page);
    }
}
