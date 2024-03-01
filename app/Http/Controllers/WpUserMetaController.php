<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\WpUserMeta;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\WpUserMetaStoreRequest;
use App\Http\Requests\WpUserMetaUpdateRequest;

class WpUserMetaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', WpUserMeta::class);

        $search = $request->get('search', '');

        $wpUserMetas = WpUserMeta::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.wp_user_metas.index',
            compact('wpUserMetas', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', WpUserMeta::class);

        return view('app.wp_user_metas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WpUserMetaStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', WpUserMeta::class);

        $validated = $request->validated();

        $wpUserMeta = WpUserMeta::create($validated);

        return redirect()
            ->route('wp-user-metas.edit', $wpUserMeta)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, WpUserMeta $wpUserMeta): View
    {
        $this->authorize('view', $wpUserMeta);

        return view('app.wp_user_metas.show', compact('wpUserMeta'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, WpUserMeta $wpUserMeta): View
    {
        $this->authorize('update', $wpUserMeta);

        return view('app.wp_user_metas.edit', compact('wpUserMeta'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        WpUserMetaUpdateRequest $request,
        WpUserMeta $wpUserMeta
    ): RedirectResponse {
        $this->authorize('update', $wpUserMeta);

        $validated = $request->validated();

        $wpUserMeta->update($validated);

        return redirect()
            ->route('wp-user-metas.edit', $wpUserMeta)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        WpUserMeta $wpUserMeta
    ): RedirectResponse {
        $this->authorize('delete', $wpUserMeta);

        $wpUserMeta->delete();

        return redirect()
            ->route('wp-user-metas.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
