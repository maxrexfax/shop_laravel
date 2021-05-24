<?php

namespace App\Repository;

interface StoreCurrencyRepositoryInterface extends EloquentRepositoryInterface {
    public function getStoreCurrenciesByStoreId($storeId);

    public function storeCurrenciesForStore($id, $request);
}