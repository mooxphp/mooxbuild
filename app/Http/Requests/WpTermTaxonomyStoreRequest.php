<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WpTermTaxonomyStoreRequest extends FormRequest
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
            'term_id' => ['required', 'max:255'],
            'taxonomy' => ['required', 'max:32', 'string'],
            'description' => ['required', 'max:255', 'string'],
            'parent' => ['required', 'max:255'],
            'count' => ['required', 'max:255'],
        ];
    }
}
