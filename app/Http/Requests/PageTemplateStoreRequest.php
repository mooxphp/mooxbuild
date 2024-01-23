<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageTemplateStoreRequest extends FormRequest
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
            'page_id' => ['required', 'exists:pages,id'],
            'title' => ['required', 'max:255', 'string'],
            'slug' => ['required', 'max:255', 'string'],
            'theme' => ['required', 'max:255', 'string'],
            'view' => ['required', 'max:255', 'string'],
        ];
    }
}
