<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\WpTermMeta;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\WpTermMetaStoreRequest;
use App\Http\Requests\WpTermMetaUpdateRequest;

class WpTermMetaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', WpTermMeta::class);

        $search = $request->get('search', '');

        $wpTermMetas = WpTermMeta::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.wp_term_metas.index',
            compact('wpTermMetas', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', WpTermMeta::class);

        return view('app.wp_term_metas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WpTermMetaStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', WpTermMeta::class);

        $validated = $request->validated();

        $wpTermMeta = WpTermMeta::create($validated);

        return redirect()
            ->route('wp-term-metas.edit', $wpTermMeta)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, WpTermMeta $wpTermMeta): View
    {
        $this->authorize('view', $wpTermMeta);

        return view('app.wp_term_metas.show', compact('wpTermMeta'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, WpTermMeta $wpTermMeta): View
    {
        $this->authorize('update', $wpTermMeta);

        return view('app.wp_term_metas.edit', compact('wpTermMeta'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        WpTermMetaUpdateRequest $request,
        WpTermMeta $wpTermMeta
    ): RedirectResponse {
        $this->authorize('update', $wpTermMeta);

        $validated = $request->validated();

        $wpTermMeta->update($validated);

        return redirect()
            ->route('wp-term-metas.edit', $wpTermMeta)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        WpTermMeta $wpTermMeta
    ): RedirectResponse {
        $this->authorize('delete', $wpTermMeta);

        $wpTermMeta->delete();

        return redirect()
            ->route('wp-term-metas.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
