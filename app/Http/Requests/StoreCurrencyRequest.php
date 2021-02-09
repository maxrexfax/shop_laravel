<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCurrencyRequest extends FormRequest
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
            'currency_name' => 'string|required|max:255',
            'currency_code' => 'string|max:10|required',
            'currency_value' => 'required|numeric|between:0,9999.99',
        ];
    }

    public function messages()
    {
        return [
            'currency_name.required' => trans('messages.currency_name_required'),
            'currency_name.max:255' => trans('messages.currency_name_max_255'),
            'currency_code.required' => trans('messages.currency_code_required'),
            'currency_code.max:10' => trans('messages.currency_code_max_10'),
            'currency_value.required' => trans('messages.currency_value_required'),
            'currency_value.numeric' => trans('messages.currency_value_numeric'),
            'currency_value.between:0,9999.99' => trans('messages.currency_from_0_to_9999'),
        ];
    }
}
