<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLocaleRequest extends FormRequest
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
            'locale_name' => ['string','required','max:255', 'min:3'],
            'locale_code' => ['string','required','max:10', 'min:2'],
            'locale_logo' => ['image'],
        ];
        if ($this->post('localeLogo') == 0) {//create PM
            $rules['locale_logo'][1] = 'required';
        }
        return $rules;
    }

    /**
     * @return string[]
     */
    public function messages()
    {
        return [
            'locale_name.required' => trans('messages.locale_name_required'),
            'locale_name.max:255' => trans('messages.locale_name_max_255'),
            'locale_code.required' => trans('messages.locale_code_required'),
            'locale_code.max:10' => trans('messages.locale_code_max_10'),
        ];
    }
}
