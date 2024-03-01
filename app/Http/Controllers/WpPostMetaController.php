<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\WpPostMeta;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\WpPostMetaStoreRequest;
use App\Http\Requests\WpPostMetaUpdateRequest;

class WpPostMetaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', WpPostMeta::class);

        $search = $request->get('search', '');

        $wpPostMetas = WpPostMeta::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.wp_post_metas.index',
            compact('wpPostMetas', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', WpPostMeta::class);

        return view('app.wp_post_metas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WpPostMetaStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', WpPostMeta::class);

        $validated = $request->validated();

        $wpPostMeta = WpPostMeta::create($validated);

        return redirect()
            ->route('wp-post-metas.edit', $wpPostMeta)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, WpPostMeta $wpPostMeta): View
    {
        $this->authorize('view', $wpPostMeta);

        return view('app.wp_post_metas.show', compact('wpPostMeta'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, WpPostMeta $wpPostMeta): View
    {
        $this->authorize('update', $wpPostMeta);

        return view('app.wp_post_metas.edit', compact('wpPostMeta'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        WpPostMetaUpdateRequest $request,
        WpPostMeta $wpPostMeta
    ): RedirectResponse {
        $this->authorize('update', $wpPostMeta);

        $validated = $request->validated();

        $wpPostMeta->update($validated);

        return redirect()
            ->route('wp-post-metas.edit', $wpPostMeta)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        WpPostMeta $wpPostMeta
    ): RedirectResponse {
        $this->authorize('delete', $wpPostMeta);

        $wpPostMeta->delete();

        return redirect()
            ->route('wp-post-metas.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
