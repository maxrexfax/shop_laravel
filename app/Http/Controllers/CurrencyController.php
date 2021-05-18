<?php

namespace App\Http\Controllers;

use App\Currency;
use App\Http\Requests\StoreCurrencyRequest;
use App\Repository\CurrencyRepositoryInterface;
use App\Services\CurrencyStoreService;
use App\Services\CurrencyValueReloadService;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public $currencyValueReloadService;
    protected $currencyRepository;

    public function __construct(CurrencyRepositoryInterface $currencyRepository)
    {
        $this->currencyValueReloadService = new CurrencyValueReloadService();
        $this->currencyRepository = $currencyRepository;
    }

    /**
     * Create new or edit existing Currency
     * @param null $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
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

    /**
     * Store Currency function in controller
     * @param null $id
     * @param StoreCurrencyRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store($id = null, StoreCurrencyRequest $request)
    {
        $currency = Currency::find($id);

        if (!$currency) {
            $currency = new Currency();
        }

        $this->currencyRepository->store($currency ,$request);
       // $this->currencyValueReloadService->store($currency ,$request);

        return redirect('/admin/currencies/list');
    }

    public function destroy($id)
    {
        $currency = Currency::find($id);

        if ($currency) {
            $currency->delete();
        }

        return redirect('/admin/currencies/list');
    }

    public function reloadCurrencyValue()
    {
        $this->currencyValueReloadService->reloadCurrenciesValues();

        return redirect()->back();
    }
}
