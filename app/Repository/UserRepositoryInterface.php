<?php

namespace App\Repository;

interface UserRepositoryInterface extends EloquentRepositoryInterface {
    public function paginateModel(int $numberOfModels);
}