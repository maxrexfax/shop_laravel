<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use function PHPUnit\Framework\countOf;

class StoreCategoryRequest extends FormRequest
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
            'category_logo' => 'image',
            'category_name' => 'string|required|max:255',
            'category_id' => 'integer|exists:categories,id|nullable',
            'sort_number' => 'integer|nullable',
            'category_description' => 'string|max:500',
        ];
        return $rules;
    }

    /**
     * @return string[]
     */
    public function messages()
    {
        return [
            'category_logo.image' => trans('messages.only_image'),
            'category_name.required' => trans('messages.category_name_required'),
            'category_name.max:255' =>trans('messages.category_name_max_255'),
            'category_id.exists:categories,id' => trans('messages.category_existing_chose'),
            'category_id.integer' => trans('messages.category_id_only_digits'),
            'sort_number.integer' => trans('messages.category_sort_only_digits'),
            'category_description.max:500' => trans('messages.category_description_500_long!'),
        ];
    }
}
