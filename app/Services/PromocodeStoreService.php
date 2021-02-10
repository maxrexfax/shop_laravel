<?php

namespace App\Services;

class PromocodeStoreService
{
    public function store($promocode, $request)
    {
        $promocode->fill($request->post());
        $promocode->save();
    }
}
