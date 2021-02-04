<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDeliveryRequest extends FormRequest
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
            'delivery_name' => 'string|required|max:255',
            'delivery_description' => 'string|max:500|required',
            'delivery_price' => 'required|numeric|between:0,9999.99',
            'active' => 'required|numeric|between:0,1',
        ];
    }

    public function messages()
    {
        return [
            'delivery_name.required' =>'Delivery name required!',
            'delivery_name.max:255' =>'Delivery name 255 symbols max!',
            'delivery_description.required' =>'Delivery description required!',
            'delivery_description.max:500' =>'Delivery description 500 symbols max!',
            'delivery_price.required' =>'Delivery price value required!',
            'delivery_price.numeric' =>'Delivery price value numeric!',
            'delivery_price.between:0,9999.99' =>'From 0 to 9999.99!',
            'active.between:0,1' =>'Incorrect data from select!',
        ];
    }
}
