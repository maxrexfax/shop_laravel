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

    public function paginateModel(int $numberToShow)
    {
        return Currency::paginate($numberToShow);
    }

    public function store($request, $currency)
    {
        $currency = $this->currencyRepository->findById($request->post('id'));

        if (empty($currency)) {
            $currency = new Currency();
        }

        $currency->currency_name = $request->post('currency_name');
        $currency->currency_code = $request->post('currency_code');
        $currency->currency_value = $request->post('currency_value');
        $currency->currency_symbol = $request->post('currency_symbol');
        $currency->save();
    }
}