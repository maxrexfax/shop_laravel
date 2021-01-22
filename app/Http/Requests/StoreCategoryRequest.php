<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
        return [
            'category_name' => 'string|required|max:255',
            'category_id' => 'integer|exists:categories,id|nullable',
            'sort_number' => 'integer|nullable',
            'category_description' => 'string|max:500',
            'category_logo' => 'string|max:255',
        ];
    }

    /**
     * @return string[]
     */
    public function messages()
    {
        return [
            'category_name.required' =>'Category name required!',
            'category_name.max:255' =>'Category name max 255 chars long!',
            'category_id.exists:categories,id' => 'Choose existing category!',
            'category_id.integer' => 'Only digit category id!',
            'sort_number.integer' => 'Only digit sort number!',
            'category_description.max:500' => 'Category description max 500 chars long!',
            'category_logo.max:255' => 'Category image name max 255 chars long!',
        ];
    }
}
