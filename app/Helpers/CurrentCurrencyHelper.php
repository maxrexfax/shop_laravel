<?php

namespace App\Helpers;

use App\Currency;
use App\Store;

class CurrentCurrencyHelper
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
}
