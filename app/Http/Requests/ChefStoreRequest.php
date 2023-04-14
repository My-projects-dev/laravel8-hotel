<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChefStoreRequest extends FormRequest
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

            'full_name.*' => 'required|string|max:50',
            'position.*' => 'required|string|max:100',
            'about.*' => 'required|string|max:700',
        ];
    }
}
