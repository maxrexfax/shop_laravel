<?php

namespace App\View\Components;

use App\Currency;
use App\Store;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Session;

class CurrenciesList extends Component
{
    public $currencies;
    public $defaultCurrency;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->currencies = Currency::where('currency_code', 'usd')->get();
        $this->defaultCurrency = Currency::find(1);
        Session::put('defaultCurrency', $this->defaultCurrency);

        $activeStore = Store::firstWhere('active', '=', Store::STORE_IS_ACTIVE);
        if ($activeStore) {
            $tmpStoreCurrency = $activeStore->getDefaultCurrency()->first();
            if ($tmpStoreCurrency) {
                $this->defaultCurrency = Currency::where('id', '=', $tmpStoreCurrency->currency_id)->first();
                $this->currencies = $activeStore->currencies;
                Session::put('defaultCurrency', $this->defaultCurrency);
            }
        }
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
