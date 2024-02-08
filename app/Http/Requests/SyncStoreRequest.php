<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SyncStoreRequest extends FormRequest
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
            'syncable_id' => ['required', 'max:255'],
            'syncable_type' => ['required', 'max:255', 'string'],
            'source_platform_id' => ['required', 'exists:platforms,id'],
            'target_platform_id' => ['required', 'exists:platforms,id'],
            'last_sync' => ['required', 'date'],
        ];
    }
}
