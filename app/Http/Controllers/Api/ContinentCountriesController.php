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

        $validated = $request->validate([
            'title' => ['required', 'max:255', 'string'],
            'slug' => ['required', 'max:255', 'string'],
            'delivery' => ['nullable', 'boolean'],
            'official' => ['required', 'max:255', 'string'],
            'native_name' => ['required', 'max:255', 'json'],
            'tld' => ['nullable', 'max:255', 'string'],
            'independent' => ['nullable', 'boolean'],
            'un_member' => ['nullable', 'boolean'],
            'status' => ['nullable', 'in:officially-assigned,user-assigned'],
            'cca2' => ['nullable', 'max:255', 'string'],
            'ccn3' => ['nullable', 'max:255', 'string'],
            'cca3' => ['nullable', 'max:255', 'string'],
            'cioc' => ['nullable', 'max:255', 'string'],
        ]);

        $country = $continent->countries()->create($validated);

        return new CountryResource($country);
    }
}
