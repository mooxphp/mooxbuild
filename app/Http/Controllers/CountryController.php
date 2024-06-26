<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\View\View;
use App\Models\Continent;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\CountryStoreRequest;
use App\Http\Requests\CountryUpdateRequest;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Country::class);

        $search = $request->get('search', '');

        $countries = Country::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.countries.index', compact('countries', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Country::class);

        $continents = Continent::pluck('title', 'id');

        return view('app.countries.create', compact('continents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CountryStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Country::class);

        $validated = $request->validated();
        $validated['native_name'] = json_decode(
            $validated['native_name'],
            true
        );

        $country = Country::create($validated);

        return redirect()
            ->route('countries.edit', $country)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Country $country): View
    {
        $this->authorize('view', $country);

        return view('app.countries.show', compact('country'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Country $country): View
    {
        $this->authorize('update', $country);

        $continents = Continent::pluck('title', 'id');

        return view('app.countries.edit', compact('country', 'continents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        CountryUpdateRequest $request,
        Country $country
    ): RedirectResponse {
        $this->authorize('update', $country);

        $validated = $request->validated();
        $validated['native_name'] = json_decode(
            $validated['native_name'],
            true
        );

        $country->update($validated);

        return redirect()
            ->route('countries.edit', $country)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Country $country
    ): RedirectResponse {
        $this->authorize('delete', $country);

        $country->delete();

        return redirect()
            ->route('countries.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
