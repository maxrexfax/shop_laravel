<?php

namespace App\Repository;

interface PhoneRepositoryInterface extends EloquentRepositoryInterface {
    public function paginateModel(int $numberOfModels);
}