<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TimezoneUpdateRequest extends FormRequest
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
            'zone_name' => ['required', 'max:255', 'string'],
            'country_code' => ['required', 'max:2', 'string'],
            'abbreviation' => ['required', 'max:6', 'string'],
            'time_start' => ['required', 'numeric'],
            'gmt_offset' => ['required', 'numeric'],
            'dst' => ['required', 'boolean'],
        ];
    }
}
