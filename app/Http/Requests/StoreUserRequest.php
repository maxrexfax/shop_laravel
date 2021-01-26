<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
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
        $rules = User::VALIDATION_RULES;

        if (!$this->post('id')) {//create user
            $rules += ['password' => 'required'];
            $rules['email'][3] = Rule::unique('users');
        } else {//update user
            $rules['email'][3] = Rule::unique('users')->ignore($this->capture()->post('id'), 'id');
        }

        return $rules;
    }

    /**
     * @return string[]
     */
    public function messages()
    {
        return [
            'store_name.required' =>'Store name required!',
            'store_name.max:255' =>'Store name 255 symbols max!',
        ];
    }
}
