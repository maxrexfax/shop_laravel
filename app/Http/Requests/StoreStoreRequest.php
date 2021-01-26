<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStoreRequest extends FormRequest
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
            'store_name' => 'string|required|max:255',
            'store_description' => 'string|max:500|nullable',
            'store_keywords' => 'string|max:500|nullable',
        ];
    }

    public function messages()
    {
        return [
            'store_name.required' =>'Store name required!',
            'store_name.max:255' =>'Store name 255 symbols max!',
        ];
    }
}
