<?php

namespace App\Http\Controllers\Api;

use App\Models\Timezone;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\TimezoneResource;
use App\Http\Resources\TimezoneCollection;
use App\Http\Requests\TimezoneStoreRequest;
use App\Http\Requests\TimezoneUpdateRequest;

class TimezoneController extends Controller
{
    public function index(Request $request): TimezoneCollection
    {
        $this->authorize('view-any', Timezone::class);

        $search = $request->get('search', '');

        $timezones = Timezone::search($search)
            ->latest()
            ->paginate();

        return new TimezoneCollection($timezones);
    }

    public function store(TimezoneStoreRequest $request): TimezoneResource
    {
        $this->authorize('create', Timezone::class);

        $validated = $request->validated();

        $timezone = Timezone::create($validated);

        return new TimezoneResource($timezone);
    }

    public function show(Request $request, Timezone $timezone): TimezoneResource
    {
        $this->authorize('view', $timezone);

        return new TimezoneResource($timezone);
    }

    public function update(
        TimezoneUpdateRequest $request,
        Timezone $timezone
    ): TimezoneResource {
        $this->authorize('update', $timezone);

        $validated = $request->validated();

        $timezone->update($validated);

        return new TimezoneResource($timezone);
    }

    public function destroy(Request $request, Timezone $timezone): Response
    {
        $this->authorize('delete', $timezone);

        $timezone->delete();

        return response()->noContent();
    }
}
