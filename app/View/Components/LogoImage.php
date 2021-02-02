<?php

namespace App\View\Components;

use App\Store;
use Illuminate\View\Component;

class LogoImage extends Component
{
    public $activeStore;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->activeStore = Store::firstWhere('active', '=', Store::STORE_IS_ACTIVE);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.logo-image', [
            'activeStore' => $this->activeStore,
        ]);
    }
}
