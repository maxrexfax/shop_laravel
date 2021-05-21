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

    public function create()
    {
        return view ('admin.partials.currency._currency_edit_create');
    }

    public function edit($id = null)
    {
        $currency = $this->currencyRepository->findById($id);

        if ($currency) {
            return view ('admin.partials.currency._currency_edit_create', [
                'currency' => $currency,
            ]);
        }
    }

    public function store(StoreCurrencyRequest $request)
    {
        $currency = new Currency();

        $this->currencyRepository->store($request, $currency);

        return redirect('admin/currencies/list');
    }

    public function update($id = null, StoreCurrencyRequest $request)
    {
        $currency = $this->currencyRepository->findById($id);

        $this->currencyRepository->store($request, $currency);

        return redirect('admin/currencies/list');
    }

    public function destroy($id)
    {
        $currency = $this->currencyRepository->findById($id);

        if ($currency) {
            $this->currencyRepository->destroy($id);
        }

        return redirect('/admin/currencies/list');
    }

    public function reloadCurrencyValue()
    {
        $this->currencyValueReloadService->reloadCurrenciesValues();

        return redirect()->back();
    }
}
