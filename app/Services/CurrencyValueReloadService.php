<?php

namespace App\Services;

use App\Currency;
use Illuminate\Support\Facades\Http;

class CurrencyValueReloadService
{
    public function reloadCurrenciesValues()
    {
        $collectionOfValues = self::getDataFromPbApi();
        $currencies = Currency::where('currency_code', '!=', Currency::CURRENCY_HRYVNA)->get();
        foreach ($currencies as $currency) {
            $dataForCurrentCurrency = $collectionOfValues->where('ccy', '=', $currency->currency_code)
                ->where('base_ccy', '=', Currency::CURRENCY_HRYVNA)
                ->first();
            $currency->currency_value = $dataForCurrentCurrency['sale'];
            $currency->save();
        }

    }

    public function getDataFromPbApi()
    {
        $response = Http::get('https://api.privatbank.ua/p24api/pubinfo?exchange&json&coursid=11');
        return collect(json_decode($response->body(), true));

    }
}
