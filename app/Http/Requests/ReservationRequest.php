<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
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
            'room_id' => 'required|integer|min:1',
            'adult' => 'required|integer|min:1',
            'child' => 'required|integer|min:0',
            'infant' => 'required|integer|min:0',
            'checkin_date' => 'required|date_format:Y-m-d|after_or_equal:today',
            'checkout_date' => 'required|date_format:Y-m-d|after:checkin_date',
            'name' => 'required|string|max:20',
            'surname' => 'required|string|max:20',
            'email' => 'required|email|max:100',
            'company_name' => 'string|max:255',
            'country' => 'required|string|max:50',
            'city' => 'required|string|max:50',
            'zip' => 'required|string|max:20',
            'phone' => 'required|string|max:30',
            'card_name' => 'required|string',
            'card_number' => 'required|string',
            'expiration_month' => 'required|digits:2',
            'expiration_year' => 'required|digits:4',
            'cvv' => 'required|digits:3',
        ];
    }
}
