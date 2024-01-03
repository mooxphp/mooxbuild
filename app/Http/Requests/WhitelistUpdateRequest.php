<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WhitelistUpdateRequest extends FormRequest
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
            'comment' => ['required', 'max:255', 'string'],
            'ip-address' => ['required', 'max:255', 'string'],
            'lookup' => ['nullable', 'max:255', 'string'],
            'expires' => ['required', 'date'],
        ];
    }
}
