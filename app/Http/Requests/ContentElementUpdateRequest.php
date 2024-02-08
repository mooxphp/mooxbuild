<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContentElementUpdateRequest extends FormRequest
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
            'description' => ['required', 'max:255', 'string'],
            'data_structure' => ['required', 'max:255', 'json'],
            'template' => ['required', 'max:255', 'string'],
            'component' => ['required', 'max:255', 'string'],
            'theme_id' => ['required', 'exists:themes,id'],
        ];
    }
}
