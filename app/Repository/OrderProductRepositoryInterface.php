<?php

namespace App\Repository;

interface OrderProductRepositoryInterface extends EloquentRepositoryInterface {
    public function destroyByForeignKeyOrderId(int $model);
}