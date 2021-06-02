<?php

namespace App\Repository;

interface OrderStatusRepositoryInterface extends EloquentRepositoryInterface
{
    public function paginateModel(int $numberOfModels);


}