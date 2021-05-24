<?php

namespace App\Repository;

interface PromocodeRepositoryInterface extends EloquentRepositoryInterface {
    public function paginateModel(int $numberOfModels);
}
