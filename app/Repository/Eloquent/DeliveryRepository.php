<?php

namespace App\Repository\Eloquent;

use App\Delivery;
use App\Repository\DeliveryRepositoryInterface;

class DeliveryRepository extends BaseRepository implements DeliveryRepositoryInterface
{
    protected $model;

    public function __construct(Delivery $model)
    {
        $this->model = $model;
    }

    public function store($request, $delivery)
    {
        $delivery->fill($request->post());
        $delivery->save();
    }
}