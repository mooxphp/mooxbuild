<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobQueueWorkerStoreRequest extends FormRequest
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
            'worker_pid' => ['required', 'max:255', 'string'],
            'queue' => ['required', 'max:255', 'string'],
            'worker_server' => ['nullable', 'max:255', 'string'],
            'supervisor' => ['nullable', 'max:255', 'string'],
            'status' => ['required', 'max:255', 'string'],
            'started_at' => ['nullable', 'date'],
            'stopped_at' => ['nullable', 'date'],
        ];
    }
}
