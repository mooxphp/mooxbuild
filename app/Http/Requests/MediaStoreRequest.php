<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class MediaStoreRequest extends FormRequest
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
            'uuid' => ['nullable', 'unique:media,uuid', 'max:255'],
            'collection_name' => ['required', 'max:255', 'string'],
            'name' => ['required', 'max:255', 'string'],
            'file_name' => ['required', 'file'],
            'mime_type' => ['nullable', 'max:255', 'string'],
            'disk' => ['required', 'max:255', 'string'],
            'conversions_disk' => ['nullable', 'max:255', 'string'],
            'size' => ['required', 'max:255'],
            'manipulations' => ['required', 'max:255', 'json'],
            'custom_properties' => ['required', 'max:255', 'json'],
            'generated_conversions' => ['required', 'max:255', 'json'],
            'responsive_images' => ['required', 'max:255', 'json'],
            'order_column' => ['nullable', 'max:255'],
            'model_id' => ['required', 'max:255'],
            'model_type' => ['required', 'max:255', 'string'],
        ];
    }
}
