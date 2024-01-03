<?php
namespace App\Http\Controllers\Api;

use App\Models\Country;
use App\Models\Timezone;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\TimezoneCollection;

class CountryTimezonesController extends Controller
{
    public function index(
        Request $request,
        Country $country
    ): TimezoneCollection {
        $this->authorize('view', $country);

        $search = $request->get('search', '');

        $timezones = $country
            ->timezones()
            ->search($search)
            ->latest()
            ->paginate();

        return new TimezoneCollection($timezones);
    }

    public function store(
        Request $request,
        Country $country,
        Timezone $timezone
    ): Response {
        $this->authorize('update', $country);

        $country->timezones()->syncWithoutDetaching([$timezone->id]);

        return response()->noContent();
    }

    public function destroy(
        Request $request,
        Country $country,
        Timezone $timezone
    ): Response {
        $this->authorize('update', $country);

        $country->timezones()->detach($timezone);

        return response()->noContent();
    }
}
