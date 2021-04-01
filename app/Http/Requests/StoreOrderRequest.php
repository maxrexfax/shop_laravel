<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
            'first_name' => 'string|required|max:255',
            'last_name' => 'string|max:255|required',
            'email' => 'string|max:255|required',
            'telephone' => 'string|max:255|required',
            'address' => 'string|max:500|required',
            'address_additional' => 'string|max:1500|nullable',
            'city' => 'string|max:125|required',
            'postcode' => 'string|max:10|required',
            'country' => 'string|max:50|required',
            'delivery_id' => 'nullable|integer|exists:deliveries,id',
            'payment_method_name' => 'nullable|string|max:50',
            'payment_method_id' => 'integer|nullable',
            'order_statuses_id' => 'nullable|integer|exists:order_statuses,id',
            'promocode_id' => 'nullable|integer|exists:promocodes,id',
        ];
    }
}
