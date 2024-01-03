<?php
namespace App\Http\Controllers\Api;

use App\Models\Country;
use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\CurrencyCollection;

class CountryCurrenciesController extends Controller
{
    public function index(
        Request $request,
        Country $country
    ): CurrencyCollection {
        $this->authorize('view', $country);

        $search = $request->get('search', '');

        $currencies = $country
            ->currencies()
            ->search($search)
            ->latest()
            ->paginate();

        return new CurrencyCollection($currencies);
    }

    public function store(
        Request $request,
        Country $country,
        Currency $currency
    ): Response {
        $this->authorize('update', $country);

        $country->currencies()->syncWithoutDetaching([$currency->id]);

        return response()->noContent();
    }

    public function destroy(
        Request $request,
        Country $country,
        Currency $currency
    ): Response {
        $this->authorize('update', $country);

        $country->currencies()->detach($currency);

        return response()->noContent();
    }
}
