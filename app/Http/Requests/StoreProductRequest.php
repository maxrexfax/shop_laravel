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
            'logo_image' => 'image',
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
            'logo_image.image' => trans('messages.spr_product_logo_only_image'),
            'product_name.required' => trans('messages.spr_product_name_required'),
            'product_name.max:255' => trans('messages.spr_product_name_255_symbols_max'),
            'rating.integer' => trans('messages.spr_rating_value_only_digit'),
            'rating.digits_between:0,5' => trans('messages.spr_rating_value_from_0_to_5'),
            'price.required' => trans('messages.spr_price_is_required'),
            'price.numeric' => trans('messages.spr_price_must_be_numeric'),
            'price.between:0,99999.99' => trans('messages.spr_price_from_0_to_99999'),
            'title.required' => trans('messages.spr_title_is_required'),
            'title.max:255' => trans('messages.spr_title_maximum_255_chars'),
            'description.required' => trans('messages.spr_description_is_required'),
            'description.max:255' => trans('messages.spr_description_maximum_255_chars'),
            'short_description.required' => trans('messages.spr_short_description_is_required'),
            'short_description.max:500' => trans('messages.spr_short_description_maximum_500_chars'),
        ];
    }
}
