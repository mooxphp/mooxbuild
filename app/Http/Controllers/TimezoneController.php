<?php

namespace App\Http\Controllers;

use App\Models\Timezone;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\TimezoneStoreRequest;
use App\Http\Requests\TimezoneUpdateRequest;

class TimezoneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Timezone::class);

        $search = $request->get('search', '');

        $timezones = Timezone::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.timezones.index', compact('timezones', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Timezone::class);

        return view('app.timezones.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TimezoneStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Timezone::class);

        $validated = $request->validated();

        $timezone = Timezone::create($validated);

        return redirect()
            ->route('timezones.edit', $timezone)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Timezone $timezone): View
    {
        $this->authorize('view', $timezone);

        return view('app.timezones.show', compact('timezone'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Timezone $timezone): View
    {
        $this->authorize('update', $timezone);

        return view('app.timezones.edit', compact('timezone'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        TimezoneUpdateRequest $request,
        Timezone $timezone
    ): RedirectResponse {
        $this->authorize('update', $timezone);

        $validated = $request->validated();

        $timezone->update($validated);

        return redirect()
            ->route('timezones.edit', $timezone)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Timezone $timezone
    ): RedirectResponse {
        $this->authorize('delete', $timezone);

        $timezone->delete();

        return redirect()
            ->route('timezones.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
