<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobBatchStoreRequest extends FormRequest
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
            'total_jobs' => ['required', 'numeric'],
            'pending_jobs' => ['required', 'numeric'],
            'failed_jobs' => ['required', 'numeric'],
            'failed_job_ids' => ['required', 'max:255', 'string'],
            'options' => ['nullable', 'max:255', 'string'],
            'cancelled_at' => ['nullable', 'numeric'],
            'created_at' => ['required', 'numeric'],
            'finished_at' => ['nullable', 'numeric'],
        ];
    }
}
