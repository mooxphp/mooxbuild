<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SessionUpdateRequest extends FormRequest
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
            'ip_address' => ['nullable', 'max:255'],
            'user_agent' => ['nullable', 'max:255', 'string'],
            'payload' => ['required', 'max:255', 'string'],
            'last_activity' => ['required', 'numeric'],
            'user_id' => ['required', 'exists:users,id'],
        ];
    }
}
