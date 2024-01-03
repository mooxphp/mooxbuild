<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\PostalCode;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\PostalCodeStoreRequest;
use App\Http\Requests\PostalCodeUpdateRequest;

class PostalCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', PostalCode::class);

        $search = $request->get('search', '');

        $postalCodes = PostalCode::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.postal_codes.index', compact('postalCodes', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', PostalCode::class);

        return view('app.postal_codes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostalCodeStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', PostalCode::class);

        $validated = $request->validated();

        $postalCode = PostalCode::create($validated);

        return redirect()
            ->route('postal-codes.edit', $postalCode)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, PostalCode $postalCode): View
    {
        $this->authorize('view', $postalCode);

        return view('app.postal_codes.show', compact('postalCode'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, PostalCode $postalCode): View
    {
        $this->authorize('update', $postalCode);

        return view('app.postal_codes.edit', compact('postalCode'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        PostalCodeUpdateRequest $request,
        PostalCode $postalCode
    ): RedirectResponse {
        $this->authorize('update', $postalCode);

        $validated = $request->validated();

        $postalCode->update($validated);

        return redirect()
            ->route('postal-codes.edit', $postalCode)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        PostalCode $postalCode
    ): RedirectResponse {
        $this->authorize('delete', $postalCode);

        $postalCode->delete();

        return redirect()
            ->route('postal-codes.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
