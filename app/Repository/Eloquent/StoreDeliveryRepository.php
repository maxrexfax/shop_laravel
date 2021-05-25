<?php

namespace App\Repository\Eloquent;

use App\Repository\StoreDeliveryRepositoryInterface;
use App\StoreDelivery;
use App\StoreLocale;
use Illuminate\Database\Eloquent\Model;

class StoreDeliveryRepository extends BaseRepository implements StoreDeliveryRepositoryInterface
{
    protected $model;

    public function __construct(StoreDelivery $model)
    {
        $this->model = $model;
    }

    public function store($request)
    {
        StoreDelivery::where('store_id', $request->post('storeId'))->delete();

        if ($request->post('deliveries')) {
            foreach ($request->post('deliveries') as $delivery) {
                $storeDelivery = new StoreDelivery();
                $storeDelivery->store_id = $request->post('storeId');
                $storeDelivery->delivery_id = $delivery;
                $storeDelivery->save();
            }
        }
    }

}
//