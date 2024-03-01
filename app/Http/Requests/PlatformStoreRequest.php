<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlatformStoreRequest extends FormRequest
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
            'domain' => ['required', 'max:255', 'string'],
            'selection' => ['nullable', 'boolean'],
            'order' => ['nullable', 'max:255'],
            'locked' => ['nullable', 'boolean'],
            'master' => ['nullable', 'boolean'],
            'thumbnail' => ['nullable', 'file'],
            'platformable_id' => ['required', 'max:255'],
            'platformable_type' => ['required', 'max:255', 'string'],
        ];
    }
}
