<?php

namespace App\Repository;

interface ProductRepositoryInterface extends EloquentRepositoryInterface {
    public function paginateModel(int $numberOfModels);

    public function getUserListBySortData($id, $sortType, $paginateQuantity);

    public function getArrayOfProductsByIds($arrayOfIds);
}