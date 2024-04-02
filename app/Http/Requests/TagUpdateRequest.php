<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagUpdateRequest extends FormRequest
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
            'uid' => ['required', 'max:255'],
            'title' => ['required', 'max:255', 'string'],
            'slug' => ['required', 'max:255', 'string'],
            'content' => ['nullable', 'max:255', 'string'],
            'data' => ['nullable', 'max:255', 'json'],
            'image' => ['nullable', 'image', 'max:1024'],
            'thumbnail' => ['nullable', 'file'],
            'weight' => ['nullable', 'numeric'],
            'model' => ['nullable', 'max:255', 'string'],
            'created_by_user_id' => ['required', 'max:255', 'string'],
            'created_by_user_name' => ['required', 'max:255', 'string'],
            'edited_by_user_id' => ['required', 'max:255', 'string'],
            'edited_by_user_name' => ['required', 'max:255', 'string'],
            'translation_id' => ['nullable', 'exists:tags,id'],
            'published_at' => ['nullable', 'date'],
        ];
    }
}
