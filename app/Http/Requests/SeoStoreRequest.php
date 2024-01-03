<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SeoStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'seoable_id' => ['required', 'max:255'],
            'seoable_type' => ['required', 'max:255', 'string'],
            'meta_title' => ['nullable', 'max:255', 'string'],
            'meta_description' => ['nullable', 'max:255', 'string'],
            'meta_keywords' => ['nullable', 'max:255', 'string'],
            'og_title' => ['nullable', 'max:255', 'string'],
            'og_description' => ['nullable', 'max:255', 'string'],
            'og_image' => ['nullable', 'max:255', 'string'],
            'twitter_card' => ['nullable', 'max:255', 'string'],
            'twitter_site' => ['nullable', 'max:255', 'string'],
            'twitter_creator' => ['nullable', 'max:255', 'string'],
            'schema_markup' => ['nullable', 'max:255', 'json'],
            'breadcrumb_title' => ['nullable', 'max:255', 'string'],
            'canonical_url' => ['nullable', 'max:255', 'string'],
            'redirect_url' => ['nullable', 'max:255', 'string'],
            'focus_keyphrases' => ['nullable', 'max:255', 'json'],
            'focus_keyphrase' => ['nullable', 'max:255', 'string'],
            'seo_scores' => ['nullable', 'max:255', 'json'],
            'seo_score' => ['nullable', 'numeric'],
            'readability_score' => ['nullable', 'numeric'],
            'fav_icon' => ['nullable', 'max:255', 'string'],
            'app_icon' => ['nullable', 'max:255', 'string'],
            'app_color' => ['nullable', 'max:255', 'string'],
            'web_manifest' => ['nullable', 'max:255', 'json'],
            'noindex' => ['nullable', 'boolean'],
            'nofollow' => ['nullable', 'boolean'],
        ];
    }
}
