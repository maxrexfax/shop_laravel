<?php

namespace App\Repository;

interface DeliveryRepositoryInterface extends EloquentRepositoryInterface {
    public function paginateModel(int $numberOfModels);
}