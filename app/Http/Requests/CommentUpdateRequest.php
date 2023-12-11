<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentUpdateRequest extends FormRequest
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
            'content' => ['required', 'max:255', 'string'],
            'translations' => ['required', 'max:255', 'json'],
            'parent_id' => ['nullable', 'exists:comments,id'],
            'author_id' => ['nullable', 'exists:authors,id'],
            'is_from_author' => ['nullable', 'boolean'],
            'name' => ['required', 'max:255', 'string'],
            'email' => ['required', 'email'],
            'avatar' => ['nullable', 'file'],
        ];
    }
}
