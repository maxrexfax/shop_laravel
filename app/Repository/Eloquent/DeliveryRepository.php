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

    public function paginateModel(int $numberToShow)
    {
        return Delivery::paginate($numberToShow);
    }

    public function store($request)
    {
        $delivery = $this->model->find($request->post('id'));
        if (empty($delivery)) {
            $delivery = new Delivery();
        }

        $delivery->fill($request->post());
        $delivery->save();
    }
}