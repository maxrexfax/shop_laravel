<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePhoneRequest extends FormRequest
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
            'phone_number' => 'required|digits:10',
            'phone_info' => 'string|required|max:255',
        ];
    }

    /**
     * @return string[]
     */
    public function messages()
    {
        return [
            'phone_number.required' => trans('messages.phone_number_required'),
            'phone_number.digits:10' => trans('messages.phone_number_digits10'),
            'phone_info.required' => trans('messages.phone_info_required'),
            'phone_info.max:255' => trans('messages.phone_info_max255'),
        ];
    }
}
