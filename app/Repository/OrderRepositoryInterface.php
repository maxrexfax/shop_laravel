<?php

namespace App\Repository;

interface OrderRepositoryInterface extends EloquentRepositoryInterface
{
    public function paginateModel(int $numberOfModels);

    public function ordersWithProducts();

    public function getOrderByUniqId($uid);
}