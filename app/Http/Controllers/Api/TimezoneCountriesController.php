<?php
namespace App\Http\Controllers\Api;

use App\Models\Country;
use App\Models\Timezone;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\CountryCollection;

class TimezoneCountriesController extends Controller
{
    public function index(
        Request $request,
        Timezone $timezone
    ): CountryCollection {
        $this->authorize('view', $timezone);

        $search = $request->get('search', '');

        $countries = $timezone
            ->countries()
            ->search($search)
            ->latest()
            ->paginate();

        return new CountryCollection($countries);
    }

    public function store(
        Request $request,
        Timezone $timezone,
        Country $country
    ): Response {
        $this->authorize('update', $timezone);

        $timezone->countries()->syncWithoutDetaching([$country->id]);

        return response()->noContent();
    }

    public function destroy(
        Request $request,
        Timezone $timezone,
        Country $country
    ): Response {
        $this->authorize('update', $timezone);

        $timezone->countries()->detach($country);

        return response()->noContent();
    }
}
