<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDeliveryStoreRequest extends FormRequest
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
            'deliveries' => 'exists:deliveries,id',
        ];
    }

    public function messages()
    {
        return [
            'deliveries.exists' => trans('messages.deliveries_id_is_wrong'),
        ];
    }

}
