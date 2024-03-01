<?php

namespace App\Http\Controllers;

use App\Models\WpTerm;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\WpTermStoreRequest;
use App\Http\Requests\WpTermUpdateRequest;

class WpTermController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', WpTerm::class);

        $search = $request->get('search', '');

        $wpTerms = WpTerm::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.wp_terms.index', compact('wpTerms', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', WpTerm::class);

        return view('app.wp_terms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WpTermStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', WpTerm::class);

        $validated = $request->validated();

        $wpTerm = WpTerm::create($validated);

        return redirect()
            ->route('wp-terms.edit', $wpTerm)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, WpTerm $wpTerm): View
    {
        $this->authorize('view', $wpTerm);

        return view('app.wp_terms.show', compact('wpTerm'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, WpTerm $wpTerm): View
    {
        $this->authorize('update', $wpTerm);

        return view('app.wp_terms.edit', compact('wpTerm'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        WpTermUpdateRequest $request,
        WpTerm $wpTerm
    ): RedirectResponse {
        $this->authorize('update', $wpTerm);

        $validated = $request->validated();

        $wpTerm->update($validated);

        return redirect()
            ->route('wp-terms.edit', $wpTerm)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, WpTerm $wpTerm): RedirectResponse
    {
        $this->authorize('delete', $wpTerm);

        $wpTerm->delete();

        return redirect()
            ->route('wp-terms.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
