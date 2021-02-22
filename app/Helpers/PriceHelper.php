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
            $currentStoreCurrency = $activeStore->getDefaultCurrency();
            if ($currentStoreCurrency) {
                $defaultCurrency = $currentStoreCurrency;
            }
        }

        return $defaultCurrency;
    }

    public function calculate($basePrice)
    {
        $defaultCurrency = $this->getCurrentCurrency();
        $mainCurrency = Currency::where('currency_code', '=', Currency::CURRENCY_MAIN)->first();
        return number_format(($basePrice * $mainCurrency->currency_value / $defaultCurrency->currency_value), 2, '.', '');
    }

    public function getCurrentCurrencySymbol()
    {
        $defaultCurrency = $this->getCurrentCurrency();
        return $defaultCurrency->currency_symbol;
    }

    public function getPriceWithSymbol($price)
    {
        $defaultCurrency = $this->getCurrentCurrency();
        $mainCurrency = Currency::where('currency_code', '=', Currency::CURRENCY_MAIN)->first();
        $price = number_format(($price * $mainCurrency->currency_value / $defaultCurrency->currency_value), 2, '.', '');
        return $price . $defaultCurrency->currency_symbol;
    }
}
