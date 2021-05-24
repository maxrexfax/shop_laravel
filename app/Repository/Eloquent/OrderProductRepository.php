<?php

namespace App\Repository\Eloquent;

use App\OrderProduct;
use App\Repository\OrderProductRepositoryInterface;

class OrderProductRepository extends BaseRepository implements OrderProductRepositoryInterface
{
    protected $model;

    public function __construct(OrderProduct $model)
    {
        $this->model = $model;
    }

    public function paginateModel(int $numberToShow)
    {
        return OrderProduct::paginate($numberToShow);
    }

    public function destroyByForeignKeyOrderId($orderId)
    {
        $op = $this->model::where('order_id', '=', $orderId);
        if($op->delete()) {
            return true;
        }
        return false;
    }
}