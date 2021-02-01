<?php

namespace App\View\Components;

use App\Currency;
use App\Locale;
use App\Store;
use Illuminate\View\Component;

class Dropdown extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $locales = Locale::all();
        $activeLocale = Locale::find(1);
        $currencies = Currency::all();
        $activeCurrency = Currency::find(1);
        $storeSearch = Store::where('active', 1)->get();
        if ($storeSearch[0]) {
            $locales = $storeSearch[0]->getLocales();
            $activeLocale = $storeSearch[0]->defaultLocale();
            $currencies = $storeSearch[0]->getCurrencies();
            $activeCurrency = $storeSearch[0]->defaultCurrency();
        }
        return view('components.dropdown', [
            'type' => 'type123',
            'message' => 'message123',
            'locales' => $locales,
            'activeLocale' => $activeLocale,
            'currencies' => $currencies,
            'activeCurrency' => $activeCurrency,
        ]);
    }
}
