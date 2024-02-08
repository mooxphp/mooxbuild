<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ActivityLogUpdateRequest extends FormRequest
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
            'log_name' => ['nullable', 'max:255', 'string'],
            'description' => ['required', 'max:255', 'string'],
            'subject_type' => ['nullable', 'max:255', 'string'],
            'event' => ['nullable', 'max:255', 'string'],
            'subject_id' => ['nullable', 'max:255'],
            'causer_type' => ['nullable', 'max:255', 'string'],
            'causer_id' => ['nullable', 'max:255'],
            'properties' => ['nullable', 'max:255', 'json'],
            'batch_uuid' => ['nullable', 'max:255'],
        ];
    }
}
