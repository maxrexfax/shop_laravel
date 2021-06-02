<?php

namespace App\Repository\Eloquent;

use App\OrderStatus;
use App\Repository\OrderStatusRepositoryInterface;

class OrderStatusRepository extends BaseRepository implements OrderStatusRepositoryInterface
{
    protected $model;

    public function __construct(OrderStatus $model)
    {
        $this->model = $model;
    }

    public function paginateModel(int $numberToShow)
    {
        return OrderStatus::paginate($numberToShow);
    }


}