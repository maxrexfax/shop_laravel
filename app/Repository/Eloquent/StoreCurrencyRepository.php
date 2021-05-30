<?php

namespace App\Repository\Eloquent;

use App\Repository\StoreCurrencyRepositoryInterface;
use App\StoreCurrency;

class StoreCurrencyRepository extends BaseRepository implements StoreCurrencyRepositoryInterface
{
    protected $model;

    public function __construct(StoreCurrency $model)
    {
        $this->model = $model;
    }

    public function getStoreCurrenciesByStoreId($storeId)
    {
        return StoreCurrency::where('store_id', '=', $storeId)->get();
    }

    public function storeCurrenciesForStore($request)
    {
        if ($request->post('currencies')) {

            StoreCurrency::where('store_id', $request->post('storeId'))->delete();

            foreach ($request->post('currencies') as $currency) {

                $storeCurrency = new StoreCurrency();
                if ($currency===$request->post('default')) {
                    $storeCurrency->default = 1;
                }
                $storeCurrency->store_id = $request->post('storeId');
                $storeCurrency->currency_id = $currency;
                $storeCurrency->save();
            }
        }
    }

}