<?php

namespace App\Services;

use App\Currency;
use App\Store;

class ProductPriceGetterService
{
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

    public function getPriceWithSymbol($price)
    {
        $defaultCurrency = self::getCurrentCurrency();
        $mainCurrency = Currency::where('currency_code', '=', Currency::CURRENCY_MAIN)->first();
        $price = number_format(($price * $mainCurrency->currency_value / $defaultCurrency->currency_value), 2, '.', '');
        return $price . $defaultCurrency->currency_symbol;
    }
}
