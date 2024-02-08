<?php

namespace App\Http\Controllers\Api;

use App\Models\Theme;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\ThemeResource;
use App\Http\Resources\ThemeCollection;
use App\Http\Requests\ThemeStoreRequest;
use App\Http\Requests\ThemeUpdateRequest;

class ThemeController extends Controller
{
    public function index(Request $request): ThemeCollection
    {
        $this->authorize('view-any', Theme::class);

        $search = $request->get('search', '');

        $themes = Theme::search($search)
            ->latest()
            ->paginate();

        return new ThemeCollection($themes);
    }

    public function store(ThemeStoreRequest $request): ThemeResource
    {
        $this->authorize('create', Theme::class);

        $validated = $request->validated();

        $theme = Theme::create($validated);

        return new ThemeResource($theme);
    }

    public function show(Request $request, Theme $theme): ThemeResource
    {
        $this->authorize('view', $theme);

        return new ThemeResource($theme);
    }

    public function update(
        ThemeUpdateRequest $request,
        Theme $theme
    ): ThemeResource {
        $this->authorize('update', $theme);

        $validated = $request->validated();

        $theme->update($validated);

        return new ThemeResource($theme);
    }

    public function destroy(Request $request, Theme $theme): Response
    {
        $this->authorize('delete', $theme);

        $theme->delete();

        return response()->noContent();
    }
}
