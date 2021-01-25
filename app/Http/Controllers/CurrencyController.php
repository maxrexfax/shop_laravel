<?php

namespace App\Http\Controllers;

use App\Currency;
use App\Http\Requests\CurrencyStoreRequest;
use App\Services\CurrencyStoreService;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function create($id = null)
    {
        if (!empty($id)) {
            $currency = Currency::find($id);

            if ($currency) {
                return view ('admin.partials._currency_edit_create', [
                    'currency' => $currency,
                    'alt_title' => 'Edit currency ' . $currency->currency_name
                ]);
            } else {
                return redirect('/admin/currencies/list');
            }

        } else {
            return view ('admin.partials._currency_edit_create', [
                'alt_title' => 'Create new currency'
            ]);
        }
    }

    public function store($id = null, CurrencyStoreRequest $request)
    {
        $currency = Currency::find($id);

        if ($currency) {
            (new CurrencyStoreService())->store($currency ,$request);

            return redirect('/admin/currencies/list');
        }

        $currency = new Currency();

        (new CurrencyStoreService())->store($currency ,$request);

        return redirect('/admin/currencies/list');
    }
}
