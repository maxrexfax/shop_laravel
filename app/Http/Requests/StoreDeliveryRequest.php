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
            'delivery_name.required' => trans('messages.deliveries_name_required'),
            'delivery_name.max:255' => trans('messages.deliveries_name_max_255'),
            'delivery_description.required' => trans('messages.deliveries_description_required'),
            'delivery_description.max:500' => trans('messages.deliveries_description_max_500'),
            'delivery_price.required' => trans('messages.deliveries_price_required'),
            'delivery_price.numeric' => trans('messages.deliveries_price_numeric'),
            'delivery_price.between:0,9999.99' => trans('messages.deliveries_price_from_0_to_9999'),
            'active.between:0,1' => trans('messages.deliveries_incorrect_select'),
        ];
    }
}
