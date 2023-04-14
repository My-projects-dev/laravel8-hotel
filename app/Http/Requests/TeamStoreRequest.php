<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeamStoreRequest extends FormRequest
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
            'status'=>'required|in:"0", "1"',
            'image'=>'required|image',
            'email'=>'required|string|max:255',
            'facebook'=>'nullable|string|max:50',
            'twitter'=>'url|nullable|max:555',
            'linkedin'=>'url|nullable|max:555',

            'full_name.*'=>'required|string|max:50',
            'position.*'=>'required|string|max:50',
        ];
    }
}
