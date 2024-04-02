<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExpiryStoreRequest extends FormRequest
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
            'item' => ['required', 'max:255', 'string'],
            'link' => ['required', 'max:255', 'string'],
            'expired_at' => ['required', 'date'],
            'notified_at' => ['required', 'date'],
            'notified_to' => ['required', 'max:255', 'string'],
            'escalated_at' => ['required', 'date'],
            'escalated_to' => ['required', 'max:255', 'string'],
            'handled_by' => ['required', 'max:255', 'string'],
            'done_at' => ['required', 'date'],
            'expiry_monitor_id' => ['required', 'exists:expiry_monitors,id'],
        ];
    }
}
