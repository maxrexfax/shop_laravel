<?php

namespace App\Repository;

use GuzzleHttp\Psr7\Request;

interface PhoneRepositoryInterface extends EloquentRepositoryInterface {
    public function paginateModel(int $numberOfModels);
    public function storePhone(Request $request);
}