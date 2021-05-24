<?php

namespace App\Repository;

interface LocaleRepositoryInterface extends EloquentRepositoryInterface {
    public function paginateModel(int $numberOfModels);
}