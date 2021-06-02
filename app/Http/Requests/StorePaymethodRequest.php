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
        $rules = [
            'login' => ['logo'],
            'payment_method_name' => ['string','required','max:500', 'min:3'],
            'payment_method_code' => ['string','required','max:25', 'min:3'],
            'other_data' => ['string','max:500','nullable'],
        ];
        if ($this->post('logoExist') == 0) {//create PM
            $rules['logo'][1] = 'required';
        }
        return $rules;
    }
}
