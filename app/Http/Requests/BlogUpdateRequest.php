<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BlogUpdateRequest extends FormRequest
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
        $id = $this->route('blog');

        return [
            'slug' => ['required', 'string', 'max:255', Rule::unique("blog_translations", "slug")->ignore($id)],
            'status' => ['required', 'in:"0", "1"'],
            'title' => ['required', 'string'],
            'content' => ['required'],
            'image' => ['image'],
        ];
    }
}
