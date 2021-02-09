<?php

namespace App\Services;

use App\StoreDelivery;

class StoreDeliveryStoreService
{
    public function store($store, $request)
    {
        StoreDelivery::where('store_id', $store->id)->delete();

        if ($request->post('deliveries')) {
            foreach ($request->post('deliveries') as $delivery) {
                $storeDelivery = new StoreDelivery();
                $storeDelivery->store_id = $store->id;
                $storeDelivery->delivery_id = $delivery;
                $storeDelivery->save();
            }
        }
    }
}
