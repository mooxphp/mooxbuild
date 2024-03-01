<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WpPostUpdateRequest extends FormRequest
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
            'post_author' => ['required', 'max:255'],
            'post_date' => ['required', 'date'],
            'post_date_gmt' => ['required', 'date'],
            'post_content' => ['required', 'max:255', 'string'],
            'post_title' => ['required', 'max:255', 'string'],
            'post_excerpt' => ['required', 'max:255', 'string'],
            'post_status' => ['required', 'max:20', 'string'],
            'comment_status' => ['required', 'max:20', 'string'],
            'ping_status' => ['required', 'max:20', 'string'],
            'post_password' => ['required', 'max:255', 'string'],
            'post_name' => ['required', 'max:200', 'string'],
            'to_ping' => ['required', 'max:255', 'string'],
            'pinged' => ['required', 'max:255', 'string'],
            'post_modified' => ['required', 'date'],
            'post_modified_gmt' => ['required', 'date'],
            'post_content_filtered' => ['required', 'max:255', 'string'],
            'post_parent' => ['required', 'max:255'],
            'guid' => ['required', 'max:255', 'string'],
            'menu_order' => ['required', 'numeric'],
            'post_type' => ['required', 'max:20', 'string'],
            'post_mime_type' => ['required', 'max:100', 'string'],
            'comment_count' => ['required', 'max:255'],
        ];
    }
}
