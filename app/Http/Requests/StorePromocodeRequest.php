<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePromocodeRequest extends FormRequest
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
            'promocode_name' => [
                'required',
                'max:30',
                'regex:/^[A-Z0-9]+$/',
            ],
            'promocode_value' => ['required', 'between:0,99.99'],
        ];
    }

    public function messages()
    {
        return [
            'promocode_name.required' => trans('messages.spr_promocode_name_required'),
            'promocode_name.max:30' => trans('messages.spr_promocode_name_30_symbols_max'),
            'promocode_value.required' => trans('messages.spr_promocode_value_required'),
            'promocode_value.between:0,99.99' => trans('messages.spr_promocode_value_wrong'),
        ];
    }
}
