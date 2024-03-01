<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\WpCommentMeta;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\WpCommentMetaStoreRequest;
use App\Http\Requests\WpCommentMetaUpdateRequest;

class WpCommentMetaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', WpCommentMeta::class);

        $search = $request->get('search', '');

        $wpCommentMetas = WpCommentMeta::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.wp_comment_metas.index',
            compact('wpCommentMetas', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', WpCommentMeta::class);

        return view('app.wp_comment_metas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WpCommentMetaStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', WpCommentMeta::class);

        $validated = $request->validated();

        $wpCommentMeta = WpCommentMeta::create($validated);

        return redirect()
            ->route('wp-comment-metas.edit', $wpCommentMeta)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, WpCommentMeta $wpCommentMeta): View
    {
        $this->authorize('view', $wpCommentMeta);

        return view('app.wp_comment_metas.show', compact('wpCommentMeta'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, WpCommentMeta $wpCommentMeta): View
    {
        $this->authorize('update', $wpCommentMeta);

        return view('app.wp_comment_metas.edit', compact('wpCommentMeta'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        WpCommentMetaUpdateRequest $request,
        WpCommentMeta $wpCommentMeta
    ): RedirectResponse {
        $this->authorize('update', $wpCommentMeta);

        $validated = $request->validated();

        $wpCommentMeta->update($validated);

        return redirect()
            ->route('wp-comment-metas.edit', $wpCommentMeta)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        WpCommentMeta $wpCommentMeta
    ): RedirectResponse {
        $this->authorize('delete', $wpCommentMeta);

        $wpCommentMeta->delete();

        return redirect()
            ->route('wp-comment-metas.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
