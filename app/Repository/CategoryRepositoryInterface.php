<?php

namespace App\Repository;

interface CategoryRepositoryInterface extends EloquentRepositoryInterface {
    public function paginateModel(int $numberOfModels);

    public function getCategoriesWithChildren();

    public function getRootCategories();

    public function getCategoriesByIdsArray($arr);
}