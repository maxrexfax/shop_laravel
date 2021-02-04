<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'product_name' => 'string|required|max:255',
            'rating' => 'integer|digits_between:0,5|nullable',
            'price' => 'required|numeric|between:0,99999.99',
            'title' => 'string|required|max:255',
            'description' => 'string|required|max:255',
            'short_description' => 'string|max:500|nullable',
            'full_description' => 'string|nullable',
        ];
    }

    /**
     * @return string[]
     */
    public function messages()
    {
        return [
            'product_name.required' =>'Product name required!',
            'product_name.max:255' =>'Product name 255 symbols max!',
            'rating.integer' =>'Rating value only digit!',
            'rating.digits_between:0,5' =>'Rating value from 0 to 5!',
            'price.required' =>'Price is required!',
            'price.numeric' =>'Price must be numeric!',
            'price.between:0,99999.99' =>'Price from 0 to 99999.99!',
            'description.required' =>'Description is required!',
            'description.max:255' =>'Description maximum 255 chars!',
            'short_description.max:500' =>'Short description maximum 500 chars!',
        ];
    }
}
