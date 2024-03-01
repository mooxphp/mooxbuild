<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WpOptionUpdateRequest extends FormRequest
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
            'option_name' => ['required', 'max:191', 'string'],
            'option_value' => ['required', 'max:255', 'string'],
            'autoload' => ['required', 'max:255', 'string'],
        ];
    }
}
