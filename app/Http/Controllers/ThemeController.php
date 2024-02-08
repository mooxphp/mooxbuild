<?php

namespace App\Http\Controllers;

use App\Models\Theme;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ThemeStoreRequest;
use App\Http\Requests\ThemeUpdateRequest;

class ThemeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Theme::class);

        $search = $request->get('search', '');

        $themes = Theme::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.themes.index', compact('themes', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Theme::class);

        return view('app.themes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ThemeStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Theme::class);

        $validated = $request->validated();

        $theme = Theme::create($validated);

        return redirect()
            ->route('themes.edit', $theme)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Theme $theme): View
    {
        $this->authorize('view', $theme);

        return view('app.themes.show', compact('theme'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Theme $theme): View
    {
        $this->authorize('update', $theme);

        return view('app.themes.edit', compact('theme'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        ThemeUpdateRequest $request,
        Theme $theme
    ): RedirectResponse {
        $this->authorize('update', $theme);

        $validated = $request->validated();

        $theme->update($validated);

        return redirect()
            ->route('themes.edit', $theme)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Theme $theme): RedirectResponse
    {
        $this->authorize('delete', $theme);

        $theme->delete();

        return redirect()
            ->route('themes.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
