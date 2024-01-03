<?php
namespace App\Http\Controllers\Api;

use App\Models\Country;
use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\CountryCollection;

class CurrencyCountriesController extends Controller
{
    public function index(
        Request $request,
        Currency $currency
    ): CountryCollection {
        $this->authorize('view', $currency);

        $search = $request->get('search', '');

        $countries = $currency
            ->countries()
            ->search($search)
            ->latest()
            ->paginate();

        return new CountryCollection($countries);
    }

    public function store(
        Request $request,
        Currency $currency,
        Country $country
    ): Response {
        $this->authorize('update', $currency);

        $currency->countries()->syncWithoutDetaching([$country->id]);

        return response()->noContent();
    }

    public function destroy(
        Request $request,
        Currency $currency,
        Country $country
    ): Response {
        $this->authorize('update', $currency);

        $currency->countries()->detach($country);

        return response()->noContent();
    }
}
