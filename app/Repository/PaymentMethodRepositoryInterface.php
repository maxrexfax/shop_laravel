<?php

namespace App\Repository;

interface PaymentMethodRepositoryInterface extends EloquentRepositoryInterface {
    public function paginateModel(int $numberOfModels);
}