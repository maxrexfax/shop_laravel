<?php

namespace App\Repository\Eloquent;

use App\Currency;
use App\Repository\CurrencyRepositoryInterface;

class CurrencyRepository extends BaseRepository implements CurrencyRepositoryInterface
{
    protected $model;

    public function __construct(Currency $model)
    {
        $this->model = $model;
    }

    public function store($currency ,$request)
    {
        $currency->currency_name = $request->post('currency_name');
        $currency->currency_code = $request->post('currency_code');
        $currency->currency_value = $request->post('currency_value');
        $currency->currency_symbol = $request->post('currency_symbol');
        $currency->save();
    }
}