<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExpiryMonitorUpdateRequest extends FormRequest
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
            'description' => ['required', 'max:255', 'string'],
            'runs' => ['required', 'in:weekly,daily,hourly'],
            'monitors' => ['required', 'max:255', 'string'],
            'executes' => ['required', 'max:255', 'string'],
            'notifies' => ['required', 'max:255', 'string'],
            'escalates' => ['required', 'max:255', 'string'],
        ];
    }
}
