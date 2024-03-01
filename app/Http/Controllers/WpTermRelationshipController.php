<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\WpTermRelationship;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\WpTermRelationshipStoreRequest;
use App\Http\Requests\WpTermRelationshipUpdateRequest;

class WpTermRelationshipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', WpTermRelationship::class);

        $search = $request->get('search', '');

        $wpTermRelationships = WpTermRelationship::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.wp_term_relationships.index',
            compact('wpTermRelationships', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', WpTermRelationship::class);

        return view('app.wp_term_relationships.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(
        WpTermRelationshipStoreRequest $request
    ): RedirectResponse {
        $this->authorize('create', WpTermRelationship::class);

        $validated = $request->validated();

        $wpTermRelationship = WpTermRelationship::create($validated);

        return redirect()
            ->route('wp-term-relationships.edit', $wpTermRelationship)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(
        Request $request,
        WpTermRelationship $wpTermRelationship
    ): View {
        $this->authorize('view', $wpTermRelationship);

        return view(
            'app.wp_term_relationships.show',
            compact('wpTermRelationship')
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(
        Request $request,
        WpTermRelationship $wpTermRelationship
    ): View {
        $this->authorize('update', $wpTermRelationship);

        return view(
            'app.wp_term_relationships.edit',
            compact('wpTermRelationship')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        WpTermRelationshipUpdateRequest $request,
        WpTermRelationship $wpTermRelationship
    ): RedirectResponse {
        $this->authorize('update', $wpTermRelationship);

        $validated = $request->validated();

        $wpTermRelationship->update($validated);

        return redirect()
            ->route('wp-term-relationships.edit', $wpTermRelationship)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        WpTermRelationship $wpTermRelationship
    ): RedirectResponse {
        $this->authorize('delete', $wpTermRelationship);

        $wpTermRelationship->delete();

        return redirect()
            ->route('wp-term-relationships.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
