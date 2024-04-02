<?php

namespace App\Http\Controllers\Api;

use App\Models\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TranslationResource;
use App\Http\Resources\TranslationCollection;

class LanguageTranslationsController extends Controller
{
    public function index(
        Request $request,
        Language $language
    ): TranslationCollection {
        $this->authorize('view', $language);

        $search = $request->get('search', '');

        $translations = $language
            ->translations2()
            ->search($search)
            ->latest()
            ->paginate();

        return new TranslationCollection($translations);
    }

    public function store(
        Request $request,
        Language $language
    ): TranslationResource {
        $this->authorize('create', Translation::class);

        $validated = $request->validate([]);

        $translation = $language->translations2()->create($validated);

        return new TranslationResource($translation);
    }
}
