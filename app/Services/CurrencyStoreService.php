<?php

namespace App\Services;

class CurrencyStoreService
{
    public function store($currency, $request)
    {
        $currency->fill($request->post());
        $currency->save();
    }
}
