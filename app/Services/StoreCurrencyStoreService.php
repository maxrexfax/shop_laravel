<?php

namespace App\Services;

use App\StoreCurrency;

class StoreCurrencyStoreService
{
//    public function store($store, $request)
//    {
//        if ($request->post('currencies')) {
//
//            StoreCurrency::where('store_id', $store->id)->delete();
//
//            foreach ($request->post('currencies') as $currency) {
//
//                $storeCurrency = new StoreCurrency();
//                if ($currency===$request->post('default')) {
//                    $storeCurrency->default = 1;
//                }
//                $storeCurrency->store_id = $store->id;
//                $storeCurrency->currency_id = $currency;
//                $storeCurrency->save();
//            }
//        }
//    }
}
