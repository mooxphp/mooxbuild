<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WpCommentStoreRequest extends FormRequest
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
            'comment_post_ID' => ['required', 'max:255'],
            'comment_author' => ['required', 'max:255', 'string'],
            'comment_author_email' => ['required', 'max:255', 'string'],
            'comment_author_url' => ['required', 'max:255', 'string'],
            'comment_author_IP' => ['required', 'max:255', 'string'],
            'comment_date' => ['required', 'date'],
            'comment_date_gmt' => ['required', 'date'],
            'comment_content' => ['required', 'max:255', 'string'],
            'comment_karma' => ['required', 'numeric'],
            'comment_approved' => ['required', 'max:255', 'string'],
            'comment_agent' => ['required', 'max:255', 'string'],
            'comment_type' => ['required', 'max:255', 'string'],
            'comment_parent' => ['required', 'max:255'],
            'user_id' => ['required', 'max:255'],
        ];
    }
}
