<?php

namespace App\Helpers;

use App\Currency;
use App\Store;

class PriceHelper
{
    public function __construct() {}

    public function getCurrentCurrency()
    {
        $defaultCurrency = Currency::find(1);

        $activeStore = Store::firstWhere('active', '=', Store::STORE_IS_ACTIVE);
        if ($activeStore) {
            $tmpStoreCurrency = $activeStore->getDefaultCurrency()->first();
            if ($tmpStoreCurrency) {
                $defaultCurrency = Currency::where('id', '=', $tmpStoreCurrency->currency_id)->first();
            }
        }

        return $defaultCurrency;
    }

    public function calculate($base_price)
    {
        $defaultCurrency = $this->getCurrentCurrency();
        $mainCurrency = Currency::where('currency_code', '=', Currency::CURRENCY_MAIN)->first();
        return number_format(($base_price * $mainCurrency->currency_value / $defaultCurrency->currency_value), 2, '.', '');
    }

    public function getCurrentCurrencySymbol()
    {
        $defaultCurrency = $this->getCurrentCurrency();
        return $defaultCurrency->currency_symbol;
    }
}
