<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CountryStoreRequest extends FormRequest
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
            'title' => ['required', 'max:255', 'string'],
            'slug' => ['required', 'max:255', 'string'],
            'continent_id' => ['required', 'exists:continents,id'],
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
        ];
    }
}
