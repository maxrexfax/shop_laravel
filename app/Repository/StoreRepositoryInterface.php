<?php

namespace App\Repository;

interface StoreRepositoryInterface extends EloquentRepositoryInterface {
    public function paginateModel(int $numberOfModels);

    public function getActiveStore();

    public function changeStoreState($model);
}