<?php
namespace App\Http\Controllers\Api;

use App\Models\Country;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\LanguageCollection;

class CountryLanguagesController extends Controller
{
    public function index(
        Request $request,
        Country $country
    ): LanguageCollection {
        $this->authorize('view', $country);

        $search = $request->get('search', '');

        $languages = $country
            ->languages()
            ->search($search)
            ->latest()
            ->paginate();

        return new LanguageCollection($languages);
    }

    public function store(
        Request $request,
        Country $country,
        Language $language
    ): Response {
        $this->authorize('update', $country);

        $country->languages()->syncWithoutDetaching([$language->id]);

        return response()->noContent();
    }

    public function destroy(
        Request $request,
        Country $country,
        Language $language
    ): Response {
        $this->authorize('update', $country);

        $country->languages()->detach($language);

        return response()->noContent();
    }
}
