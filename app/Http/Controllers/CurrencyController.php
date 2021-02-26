<?php

namespace App\Http\Controllers;

use App\Currency;
use App\Http\Requests\StoreCurrencyRequest;
use App\Services\CurrencyStoreService;
use App\Services\CurrencyValueReloadService;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public $currencyValueReloadService;

    public function __construct()
    {
        $this->currencyValueReloadService = new CurrencyValueReloadService();
    }

    public function create($id = null)
    {
        if (!empty($id)) {
            $currency = Currency::find($id);

            if ($currency) {
                return view ('admin.partials.currency._currency_edit_create', [
                    'currency' => $currency,
                ]);
            } else {
                return redirect('/admin/currencies/list');
            }

        } else {
            return view ('admin.partials.currency._currency_edit_create');
        }
    }

    public function store($id = null, StoreCurrencyRequest $request)
    {
        $currency = Currency::find($id);

        if (!$currency) {
            $currency = new Currency();
        }

        $this->currencyValueReloadService->store($currency ,$request);

        return redirect('/admin/currencies/list');
    }

    public function reloadCurrencyValue()
    {
        $this->currencyValueReloadService->reloadCurrenciesValues();

        return redirect()->back();
    }
}
