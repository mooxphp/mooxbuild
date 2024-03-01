<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WpCommentMetaStoreRequest extends FormRequest
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
            'comment_id' => ['required', 'max:255'],
            'meta_key' => ['required', 'max:255', 'string'],
            'meta_value' => ['required', 'max:255', 'string'],
        ];
    }
}
