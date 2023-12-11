<?php
namespace App\Http\Controllers\Api;

use App\Models\Country;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\CountryCollection;

class LanguageCountriesController extends Controller
{
    public function index(
        Request $request,
        Language $language
    ): CountryCollection {
        $this->authorize('view', $language);

        $search = $request->get('search', '');

        $countries = $language
            ->countries()
            ->search($search)
            ->latest()
            ->paginate();

        return new CountryCollection($countries);
    }

    public function store(
        Request $request,
        Language $language,
        Country $country
    ): Response {
        $this->authorize('update', $language);

        $language->countries()->syncWithoutDetaching([$country->id]);

        return response()->noContent();
    }

    public function destroy(
        Request $request,
        Language $language,
        Country $country
    ): Response {
        $this->authorize('update', $language);

        $language->countries()->detach($country);

        return response()->noContent();
    }
}
