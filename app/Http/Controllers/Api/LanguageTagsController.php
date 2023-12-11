<?php

namespace App\Http\Controllers\Api;

use App\Models\Language;
use Illuminate\Http\Request;
use App\Http\Resources\TagResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\TagCollection;

class LanguageTagsController extends Controller
{
    public function index(Request $request, Language $language): TagCollection
    {
        $this->authorize('view', $language);

        $search = $request->get('search', '');

        $tags = $language
            ->tags()
            ->search($search)
            ->latest()
            ->paginate();

        return new TagCollection($tags);
    }

    public function store(Request $request, Language $language): TagResource
    {
        $this->authorize('create', Tag::class);

        $validated = $request->validate([
            'uid' => ['required', 'max:255'],
            'title' => ['required', 'max:255', 'string'],
            'slug' => ['required', 'max:255', 'string'],
            'content' => ['nullable', 'max:255', 'string'],
            'data' => ['nullable', 'max:255', 'json'],
            'image' => ['nullable', 'image', 'max:1024'],
            'thumbnail' => ['nullable', 'file'],
            'weight' => ['nullable', 'numeric'],
            'model' => ['nullable', 'max:255', 'string'],
            'translation_id' => ['nullable', 'exists:tags,id'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request
                ->file('thumbnail')
                ->store('public');
        }

        $tag = $language->tags()->create($validated);

        return new TagResource($tag);
    }
}
