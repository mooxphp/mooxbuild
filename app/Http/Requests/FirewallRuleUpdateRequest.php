<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FirewallRuleUpdateRequest extends FormRequest
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
            'rule' => ['required', 'max:255', 'string'],
            'type' => ['required', 'in:allow,deny'],
            'ip_address' => ['nullable', 'max:255'],
        ];
    }
}
