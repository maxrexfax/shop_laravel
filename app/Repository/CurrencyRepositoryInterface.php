<?php

namespace App\Repository;

interface CurrencyRepositoryInterface extends EloquentRepositoryInterface {
    public function paginateModel(int $numberOfModels);
}