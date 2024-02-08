<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobManagerUpdateRequest extends FormRequest
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
            'job_id' => ['required', 'max:255', 'string'],
            'name' => ['nullable', 'max:255', 'string'],
            'queue' => ['nullable', 'max:255', 'string'],
            'available_at' => ['required', 'date'],
            'started_at' => ['nullable', 'date'],
            'finished_at' => ['nullable', 'date'],
            'failed' => ['required', 'boolean'],
            'attempt' => ['required', 'numeric'],
            'progress' => ['nullable', 'numeric'],
            'exception_message' => ['nullable', 'max:255', 'string'],
            'status' => ['required', 'max:255', 'string'],
            'job_queue_worker_id' => [
                'required',
                'exists:job_queue_workers,id',
            ],
        ];
    }
}
