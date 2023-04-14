<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoomStoreRequest extends FormRequest
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
            'price' => 'required|numeric|min:0',
            'adult' => 'required|integer|min:1',
            'child' => 'required|integer|min:0',
            'number_of_rooms' => 'required|integer|min:0|max:255',
            'amenity.*' => 'integer|min:1|exists:App\Models\Amenity,id',
            'type' => 'required|integer|min:1|exists:App\Models\RoomType,id',
            'main_image' => 'required|image',
            'images.*' => 'image',

            'slug.*' => 'required|alpha_dash|unique:room_translations,slug',
            'title.*' => 'required|string|max:255',
            'overview.*' => 'required|string',
            'rules.*' => 'required|string',
        ];
    }
}
