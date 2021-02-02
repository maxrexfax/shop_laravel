<?php

namespace App\View\Components;

use App\Locale;
use App\Store;
use App\StoreLocale;
use Illuminate\View\Component;

class LocalesList extends Component
{
    public $locales;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->locales = Locale::where('locale_code', 'en')->get();

        $activeStore = Store::firstWhere('active', '=', Store::STORE_IS_ACTIVE);
        if ($activeStore) {
            $this->locales = $activeStore->locales;
        }

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.locales-list');
    }
}
