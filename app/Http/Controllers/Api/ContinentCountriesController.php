<?php

namespace App\Http\Controllers\Api;

use App\Models\Continent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CountryResource;
use App\Http\Resources\CountryCollection;

class ContinentCountriesController extends Controller
{
    public function index(
        Request $request,
        Continent $continent
    ): CountryCollection {
        $this->authorize('view', $continent);

        $search = $request->get('search', '');

        $countries = $continent
            ->countries()
            ->search($search)
            ->latest()
            ->paginate();

        return new CountryCollection($countries);
    }

    public function store(
        Request $request,
        Continent $continent
    ): CountryResource {
        $this->authorize('create', Country::class);

        $validated = $request->validate([]);

        $country = $continent->countries()->create($validated);

        return new CountryResource($country);
    }
}
