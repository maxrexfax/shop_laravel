<?php

namespace App\Http\Controllers;

use App\Currency;
use App\Http\Requests\EditCurrencyRequest;
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

    public function edit(EditCurrencyRequest $request)
    {
        return view ('admin.partials.currency._currency_edit_create', [
            'currency' => $this->currencyRepository->findById($request->get('id')),
        ]);
    }

    public function store(StoreCurrencyRequest $request)
    {
        $this->currencyRepository->store($request);

        return redirect('admin/currencies/list');
    }

    public function update(StoreCurrencyRequest $request)
    {
        $this->currencyRepository->store($request);

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
