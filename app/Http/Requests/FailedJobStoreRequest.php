<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FailedJobStoreRequest extends FormRequest
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
            'uuid' => ['required', 'max:255', 'string'],
            'connection' => ['required', 'max:255', 'string'],
            'queue' => ['required', 'max:255', 'string'],
            'payload' => ['required', 'max:255', 'string'],
            'exception' => ['required', 'max:255', 'string'],
            'failed_at' => ['required', 'date'],
        ];
    }
}
