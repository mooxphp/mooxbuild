<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobUpdateRequest extends FormRequest
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
            'queue' => ['required', 'max:255', 'string'],
            'payload' => ['required', 'max:255', 'string'],
            'attempts' => ['required', 'max:255'],
            'reserved_at' => ['nullable', 'max:255'],
            'available_at' => ['required', 'max:255'],
            'created_at' => ['required', 'max:255'],
        ];
    }
}
