<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthorUpdateRequest extends FormRequest
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
            'user_id' => ['required', 'exists:users,id'],
            'salutation' => ['required', 'max:255', 'string'],
            'title' => ['required', 'max:255', 'string'],
            'name' => ['required', 'max:255', 'string'],
            'full_name' => ['required', 'max:255', 'string'],
            'first_name' => ['required', 'max:255', 'string'],
            'last_name' => ['required', 'max:255', 'string'],
            'mail_address' => ['required', 'max:255', 'string'],
            'website' => ['required', 'max:255', 'string'],
            'address' => ['required', 'max:255', 'string'],
            'social' => ['required', 'max:255', 'json'],
        ];
    }
}
