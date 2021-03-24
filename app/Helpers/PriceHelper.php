<?php

namespace App\Helpers;

use App\Currency;
use App\Store;
use Illuminate\Support\Facades\Session;

class PriceHelper
{
    public function __construct() {}

    public function getCurrentCurrency()
    {
        $defaultCurrency = null;
        if (session()->has('defaultCurrency')) {
            $defaultCurrency = Session::get('defaultCurrency');
        } else {
            $defaultCurrency = $this->getCurrentCurrencyFromDb();
            Session::put('defaultCurrency', $defaultCurrency);
        }

        return $defaultCurrency;
    }

    public function getMainCurrency()
    {
        $mainCurrency = null;
        if (session()->has('mainCurrency')) {
            $mainCurrency = Session::get('mainCurrency');
        } else {
            $mainCurrency = Currency::where('currency_code', '=', Currency::CURRENCY_MAIN)->first();
            Session::put('mainCurrency', $mainCurrency);
        }

        return $mainCurrency;
    }

    public function getCurrentCurrencyFromDb()
    {
        $defaultCurrency = Currency::firstWhere('currency_code', Currency::CURRENCY_MAIN);

        if ($activeStore = Store::firstWhere('active', '=', Store::STORE_IS_ACTIVE)) {
            if ($currentStoreCurrency = $activeStore->getDefaultCurrency()) {
                $defaultCurrency = $currentStoreCurrency;
            }
        }

        return $defaultCurrency;
    }

    public function calculate($basePrice)
    {
        $defaultCurrency = $this->getCurrentCurrency();
        $mainCurrency = $this->getMainCurrency();
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
        $mainCurrency = $this->getMainCurrency();
        $price = number_format(($price * $mainCurrency->currency_value / $defaultCurrency->currency_value), 2, '.', '');
        return $price . $defaultCurrency->currency_symbol;
    }
}
