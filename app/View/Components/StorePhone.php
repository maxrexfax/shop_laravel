<?php

namespace App\View\Components;

use App\Store;
use Illuminate\View\Component;

class StorePhone extends Component
{
    public $activeStore;
    public $phones;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->activeStore = Store::firstWhere('active', '=', Store::STORE_IS_ACTIVE);
        if ($this->activeStore) {
            $this->phones = $this->activeStore->getPhones();
        } else {
            $this->phones = null;
        }

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.store-phone');
    }
}
