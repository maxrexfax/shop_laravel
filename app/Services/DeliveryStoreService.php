<?php

namespace App\Services;

class DeliveryStoreService
{
    public function store($delivery, $request)
    {
        $delivery->fill($request->post());
        $delivery->save();
    }
}
