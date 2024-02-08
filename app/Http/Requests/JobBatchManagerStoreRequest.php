<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobBatchManagerStoreRequest extends FormRequest
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
            'batch_id' => ['required', 'max:255', 'string'],
            'name' => ['required', 'max:255', 'string'],
            'total_jobs' => ['required', 'numeric'],
            'pending_jobs' => ['required', 'numeric'],
            'failed_jobs' => ['required', 'numeric'],
            'failed_job_ids' => ['required', 'max:255', 'string'],
            'options' => ['nullable', 'max:255', 'string'],
            'cancelled_at' => ['nullable', 'date'],
            'finished_at' => ['nullable', 'date'],
            'status' => ['required', 'max:255', 'string'],
        ];
    }
}
