<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NearByStoreRequest extends FormRequest
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

            'button_title.*' => 'required|string|max:20',
            'button_url.*' => 'url|required|max:555',
        ];
    }
}
