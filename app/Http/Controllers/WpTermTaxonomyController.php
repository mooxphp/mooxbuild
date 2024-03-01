<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\WpTermTaxonomy;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\WpTermTaxonomyStoreRequest;
use App\Http\Requests\WpTermTaxonomyUpdateRequest;

class WpTermTaxonomyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', WpTermTaxonomy::class);

        $search = $request->get('search', '');

        $wpTermTaxonomies = WpTermTaxonomy::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.wp_term_taxonomies.index',
            compact('wpTermTaxonomies', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', WpTermTaxonomy::class);

        return view('app.wp_term_taxonomies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WpTermTaxonomyStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', WpTermTaxonomy::class);

        $validated = $request->validated();

        $wpTermTaxonomy = WpTermTaxonomy::create($validated);

        return redirect()
            ->route('wp-term-taxonomies.edit', $wpTermTaxonomy)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, WpTermTaxonomy $wpTermTaxonomy): View
    {
        $this->authorize('view', $wpTermTaxonomy);

        return view('app.wp_term_taxonomies.show', compact('wpTermTaxonomy'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, WpTermTaxonomy $wpTermTaxonomy): View
    {
        $this->authorize('update', $wpTermTaxonomy);

        return view('app.wp_term_taxonomies.edit', compact('wpTermTaxonomy'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        WpTermTaxonomyUpdateRequest $request,
        WpTermTaxonomy $wpTermTaxonomy
    ): RedirectResponse {
        $this->authorize('update', $wpTermTaxonomy);

        $validated = $request->validated();

        $wpTermTaxonomy->update($validated);

        return redirect()
            ->route('wp-term-taxonomies.edit', $wpTermTaxonomy)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        WpTermTaxonomy $wpTermTaxonomy
    ): RedirectResponse {
        $this->authorize('delete', $wpTermTaxonomy);

        $wpTermTaxonomy->delete();

        return redirect()
            ->route('wp-term-taxonomies.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
