<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderStoreRequest extends FormRequest
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
            'star'=>'required|in:"0", "1", "2", "3", "4", "5"',
            'status'=>'required|in:"0", "1"',
            'image'=>'required|image',

            'title.*'=>'required|string|max:255',
            'subtitle.*'=>'required|string|max:255',
            'button_title.*'=>'nullable|string|max:50',
            'button_url.*'=>'url|nullable|max:555',
        ];
    }
}
