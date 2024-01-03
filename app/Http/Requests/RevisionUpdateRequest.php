<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RevisionUpdateRequest extends FormRequest
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
            'revname' => ['nullable', 'max:255', 'string'],
            'revcomment' => ['nullable', 'max:255', 'string'],
            'revretention' => ['nullable', 'date'],
            'uid' => ['required', 'max:255'],
            'main_category_id' => ['nullable', 'max:255'],
            'title' => ['required', 'max:255', 'string'],
            'slug' => ['required', 'max:255', 'string'],
            'short' => ['nullable', 'max:255', 'string'],
            'content' => ['nullable', 'max:255', 'string'],
            'data' => ['nullable', 'max:255', 'json'],
            'image' => ['nullable', 'image', 'max:1024'],
            'thumbnail' => ['nullable', 'file'],
            'author_id' => ['required', 'max:255'],
            'language_id' => ['nullable', 'max:255'],
            'translation_id' => ['nullable', 'max:255'],
            'categories' => ['nullable', 'max:255', 'json'],
            'tags' => ['nullable', 'max:255', 'json'],
            'fields' => ['nullable', 'max:255', 'json'],
        ];
    }
}
