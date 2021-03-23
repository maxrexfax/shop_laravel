<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePaymethodRequest extends FormRequest
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
            'logo' => 'image|required',
            'payment_method_name' => 'string|required|max:500',
            'payment_method_code' => 'string|required|max:25',
            'other_data' => 'string|max:500|nullable',
        ];
    }
}
