<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SettingUpdateRequest extends FormRequest
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
        $id = $this->ids;

        return [
            'key' => ['required', 'string','max:255', Rule::unique('settings', 'key')->ignore($id)],
            'value' => ['required', 'string','max:255'],
            'status'=>['required', 'boolean'],
            'image'=>['image']
        ];
    }
}
