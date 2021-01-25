<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CurrencyStoreRequest extends FormRequest
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
            'currency_name.required' =>'Currency name required!',
            'currency_name.max:255' =>'Currency name 255 symbols max!',
            'currency_code.required' =>'Currency code required!',
            'currency_code.max:10' =>'Currency code 10 symbols max!',
            'currency_value.required' =>'Currency value required!',
            'currency_value.numeric' =>'Currency value numeric!',
            'currency_value.between:0,9999.99' =>'From 0 to 9999.99!',
        ];
    }
}
