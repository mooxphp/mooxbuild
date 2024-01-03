<?php

namespace App\Http\Controllers;

use App\Models\Seo;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\SeoStoreRequest;
use App\Http\Requests\SeoUpdateRequest;

class SeoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Seo::class);

        $search = $request->get('search', '');

        $seos = Seo::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.seos.index', compact('seos', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Seo::class);

        return view('app.seos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SeoStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Seo::class);

        $validated = $request->validated();
        $validated['schema_markup'] = json_decode(
            $validated['schema_markup'],
            true
        );

        $validated['focus_keyphrases'] = json_decode(
            $validated['focus_keyphrases'],
            true
        );

        $validated['seo_scores'] = json_decode($validated['seo_scores'], true);

        $validated['web_manifest'] = json_decode(
            $validated['web_manifest'],
            true
        );

        $seo = Seo::create($validated);

        return redirect()
            ->route('seos.edit', $seo)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Seo $seo): View
    {
        $this->authorize('view', $seo);

        return view('app.seos.show', compact('seo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Seo $seo): View
    {
        $this->authorize('update', $seo);

        return view('app.seos.edit', compact('seo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        SeoUpdateRequest $request,
        Seo $seo
    ): RedirectResponse {
        $this->authorize('update', $seo);

        $validated = $request->validated();
        $validated['schema_markup'] = json_decode(
            $validated['schema_markup'],
            true
        );

        $validated['focus_keyphrases'] = json_decode(
            $validated['focus_keyphrases'],
            true
        );

        $validated['seo_scores'] = json_decode($validated['seo_scores'], true);

        $validated['web_manifest'] = json_decode(
            $validated['web_manifest'],
            true
        );

        $seo->update($validated);

        return redirect()
            ->route('seos.edit', $seo)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Seo $seo): RedirectResponse
    {
        $this->authorize('delete', $seo);

        $seo->delete();

        return redirect()
            ->route('seos.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
