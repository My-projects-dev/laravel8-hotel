<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'status' => 'required|in:"0", "1"',
            'image' => 'required|image',

            'slug.*' => 'required|alpha_dash|unique:blog_translations,slug',
            'title.*' => 'required|string|max:255',
            'content.*' => 'required',
        ];
    }
}
