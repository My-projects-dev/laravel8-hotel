<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RoomUpdateRequest extends FormRequest
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
        $id = $this->route('room');

        return [
            'slug' => ['required', 'string', 'max:255', Rule::unique("room_translations", "slug")->ignore($id)],
            'type' => ['required', 'integer', 'min:1', 'exists:App\Models\RoomType,id'],
            'amenity.*' => ['integer', 'min:1', 'exists:App\Models\Amenity,id'],
            'status' => ['required', 'in:"0", "1"'],
            'price' => ['required', 'numeric', 'min:0'],
            'adult' => ['required', 'integer', 'min:1'],
            'child' => ['required', 'integer', 'min:0'],
            'number_of_rooms'=>['required','integer','min:0','max:255'],
            'title' => ['required', 'string', 'max:255'],
            'overview' => ['required', 'string'],
            'rules' => ['required', 'nullable'],
            'images.*' => ['image'],
            'image.*' => ['image'],
            'id.*' => ['integer', 'min:1', 'exists:App\Models\RoomImage,id'],
            'main' => ['integer', 'min:0'],
        ];
    }
}
