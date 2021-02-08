<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreImageRequest extends FormRequest
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
            'imageAdd' => 'image',
            'product_id' => 'exists:products,id'
        ];
    }

    /**
     * @return string[]
     */
    public function messages()
    {
        return [
            'imageAdd.image' => trans('messages.only_image'),
            'product_id.exists' => trans('messages.wrong_product_id'),
        ];
    }
}
