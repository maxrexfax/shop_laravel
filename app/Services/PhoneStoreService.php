<?php

namespace App\Services;

use App\Http\Requests\StorePhoneRequest;
use http\Env\Request;

class PhoneStoreService
{
    public function storePhone(StorePhoneRequest $request, $phone)
    {
        $phone->phone_number = $request->post('phone_number');
        $phone->phone_info = $request->post('phone_info');
        $phone->store_id = $request->post('store_id');
        $phone->save();
    }

}
