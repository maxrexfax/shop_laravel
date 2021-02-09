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
            'login.required' => trans('messages.sur_user_login_required'),
            'login.max:255' => trans('messages.sur_user_login_255_symbols_max'),
            'first_name.max:255' => trans('messages.sur_user_first_name_255_symbols_max'),
            'second_name.max:255' => trans('messages.sur_user_second_name_255_symbols_max'),
            'last_name.max:255' => trans('messages.sur_user_last_name_255_symbols_max'),
            'email.required' => trans('messages.sur_email_required'),
            'email.max:255' => trans('messages.sur_email_255_symbols_max'),
            'password.required' => trans('messages.Password required!'),
        ];
    }
}
