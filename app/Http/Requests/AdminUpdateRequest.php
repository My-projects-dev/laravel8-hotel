<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdminUpdateRequest extends FormRequest
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
        $id = $this->route('admin');

        return [
            'name'=>['required', 'string', 'max:254'],
            'email' => ['required', 'email','max:254', Rule::unique('users', 'email')->ignore($id)],
            'password'=>['string', 'nullable', 'max:254'],
        ];
    }
}
