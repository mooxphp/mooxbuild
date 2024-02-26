<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            'name' => ['required', 'max:255', 'string'],
            'slug' => ['required', 'max:255', 'string'],
            'gender' => ['required', 'in:male,female,other'],
            'title' => ['nullable', 'max:255', 'string'],
            'first_name' => ['required', 'max:255', 'string'],
            'last_name' => ['required', 'max:255', 'string'],
            'email' => ['required', 'unique:users,email', 'email'],
            'website' => ['nullable', 'max:255', 'string'],
            'description' => ['nullable', 'max:255', 'string'],
            'password' => ['required'],
            'profile_photo_path' => ['nullable', 'max:255', 'string'],
            'wp_id' => ['nullable', 'max:255'],
            'language_id' => ['required', 'exists:languages,id'],
            'roles' => 'array',
        ];
    }
}
