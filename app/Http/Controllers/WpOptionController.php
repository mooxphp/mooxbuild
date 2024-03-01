<?php

namespace App\Http\Controllers;

use App\Models\WpOption;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\WpOptionStoreRequest;
use App\Http\Requests\WpOptionUpdateRequest;

class WpOptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', WpOption::class);

        $search = $request->get('search', '');

        $wpOptions = WpOption::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.wp_options.index', compact('wpOptions', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', WpOption::class);

        return view('app.wp_options.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WpOptionStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', WpOption::class);

        $validated = $request->validated();

        $wpOption = WpOption::create($validated);

        return redirect()
            ->route('wp-options.edit', $wpOption)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, WpOption $wpOption): View
    {
        $this->authorize('view', $wpOption);

        return view('app.wp_options.show', compact('wpOption'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, WpOption $wpOption): View
    {
        $this->authorize('update', $wpOption);

        return view('app.wp_options.edit', compact('wpOption'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        WpOptionUpdateRequest $request,
        WpOption $wpOption
    ): RedirectResponse {
        $this->authorize('update', $wpOption);

        $validated = $request->validated();

        $wpOption->update($validated);

        return redirect()
            ->route('wp-options.edit', $wpOption)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        WpOption $wpOption
    ): RedirectResponse {
        $this->authorize('delete', $wpOption);

        $wpOption->delete();

        return redirect()
            ->route('wp-options.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
