<?php

namespace App\View\Components;

use App\Currency;
use App\Store;
use App\StoreCurrency;
use Illuminate\View\Component;

class CurrenciesList extends Component
{
    public $currencies;
    //public $activeStore;
    public $defaultCurrency;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $activeStore = Store::firstWhere('active', '=', Store::STORE_IS_ACTIVE);
        $this->currencies = $activeStore->currencies;
        $storeCurrencyDefault = StoreCurrency::where('store_id', '=', $activeStore->id)->where('default', '=', Currency::IS_DEFAULT_CURRENCY)->first();
        $this->defaultCurrency = Currency::find($storeCurrencyDefault->currency_id);

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.currencies-list');
    }
}
