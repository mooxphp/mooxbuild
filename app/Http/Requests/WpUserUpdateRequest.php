<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WpUserUpdateRequest extends FormRequest
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
            'user_login' => ['required', 'max:60', 'string'],
            'user_pass' => ['required', 'max:255', 'string'],
            'user_nicename' => ['required', 'max:50', 'string'],
            'user_email' => ['required', 'max:100', 'string'],
            'user_url' => ['required', 'max:100', 'string'],
            'user_registered' => ['required', 'date'],
            'user_activation_key' => ['required', 'max:255', 'string'],
            'user_status' => ['required', 'numeric'],
            'display_name' => ['required', 'max:255', 'string'],
            'spam' => ['required', 'boolean'],
            'deleted' => ['required', 'boolean'],
        ];
    }
}
