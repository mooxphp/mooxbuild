<?php

namespace App\Http\Controllers\Api;

use App\Models\Theme;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ContentElementResource;
use App\Http\Resources\ContentElementCollection;

class ThemeContentElementsController extends Controller
{
    public function index(
        Request $request,
        Theme $theme
    ): ContentElementCollection {
        $this->authorize('view', $theme);

        $search = $request->get('search', '');

        $contentElements = $theme
            ->contentElements()
            ->search($search)
            ->latest()
            ->paginate();

        return new ContentElementCollection($contentElements);
    }

    public function store(
        Request $request,
        Theme $theme
    ): ContentElementResource {
        $this->authorize('create', ContentElement::class);

        $validated = $request->validate([
            'title' => ['required', 'max:255', 'string'],
            'slug' => ['required', 'max:255', 'string'],
            'description' => ['required', 'max:255', 'string'],
            'data_structure' => ['required', 'max:255', 'json'],
            'template' => ['required', 'max:255', 'string'],
            'component' => ['required', 'max:255', 'string'],
        ]);

        $contentElement = $theme->contentElements()->create($validated);

        return new ContentElementResource($contentElement);
    }
}
