<?php

namespace App\Http\Controllers;

use App\Currency;
use App\Delivery;
use App\Helpers\PriceHelper;
use App\Http\Requests\StoreDeliveryStoreRequest;
use App\Http\Requests\StoreStoreRequest;
use App\Locale;
use App\Repository\CurrencyRepositoryInterface;
use App\Repository\DeliveryRepositoryInterface;
use App\Repository\LocaleRepositoryInterface;
use App\Repository\StoreCurrencyRepositoryInterface;
use App\Repository\StoreRepositoryInterface;
use App\Services\StoreCurrencyStoreService;
use App\Services\StoreDeliveryStoreService;
use App\Services\StoreLocaleStoreService;
use App\Services\StoreStoreService;
use App\Store;
use App\StoreCurrency;
use App\StoreLocale;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class StoreController extends Controller
{
    protected $storeRepository;
    protected $localeRepository;
    protected $deliveryRepository;
    protected $currencyRepository;
    protected $storeCurrencyRepository;

    public function __construct(StoreRepositoryInterface $storeRepository, LocaleRepositoryInterface $localeRepository,
                                DeliveryRepositoryInterface $deliveryRepository, CurrencyRepositoryInterface $currencyRepository,
                                StoreCurrencyRepositoryInterface $storeCurrencyRepository)
    {
        $this->storeRepository = $storeRepository;
        $this->localeRepository = $localeRepository;
        $this->deliveryRepository = $deliveryRepository;
        $this->currencyRepository = $currencyRepository;
        $this->storeCurrencyRepository = $storeCurrencyRepository;
    }

    public function create($id = null)
    {
        return view ('admin.partials.store._store_edit_create');
    }

    public function edit($id = null)
    {
        if (!empty($id)) {
            $store = $this->storeRepository->findById($id);
            if ($store) {
                return view ('admin.partials.store._store_edit_create', [
                    'store' => $store,
                ]);
            }
        }

        return redirect('/admin/stores/list');
    }

    public function store(StoreStoreRequest $request)
    {
        $this->storeRepository->store($request);

        return redirect('/admin/stores/list');
    }

    public function update(StoreStoreRequest $request)
    {
        $this->storeRepository->store($request);

        return redirect('/admin/stores/list');
    }

    public function phoneList($id = null)
    {
        $store = $this->storeRepository->findById($id);

        if ($store) {
            return view('admin.partials.phones._phones_list', [
                'store' => $store,
                'phones' => $store->getPhones(),
            ]);
        }

        return redirect('/admin/stores/list');
    }

    public function languageList($id = null)
    {
        $store = $this->storeRepository->findById($id);

        if ($store) {
            return view('admin.partials.locale._store_locale_list', [
                'store' => $store,
                'locales' => $this->localeRepository->all(),
            ]);
        }
    }

    public function storeLocales($id, Request $request)
    {
        $store = $this->storeRepository->findById($id);

        if ($store) {
            (new StoreLocaleStoreService())->store($store, $request);
        }

        return redirect()->back();
    }

    public function storeDelivery($id, StoreDeliveryStoreRequest $request)
    {
        $store = $this->storeRepository->findById($id);

        if ($store) {
            (new StoreDeliveryStoreService())->store($store, $request);
        }

        return redirect()->back();
    }

    public function currencyList($id)
    {
        return view('admin.partials.currency._store_currency_list', [
            'store' => $this->storeRepository->findById($id),
            'currencies' => $this->currencyRepository->all()
        ]);
    }

    public function deliveryList($id)
    {
        return view('admin.partials.delivery._store_delivery_list', [
            'store' => $this->storeRepository->findById($id),
            'deliveries' => $this->deliveryRepository->all()
        ]);
    }

    public function storeCurrency($id, Request $request)
    {
        $this->storeCurrencyRepository->storeCurrenciesForStore($id, $request);

        return redirect()->back();
    }

    public function changeActive($id)
    {
        $this->storeRepository->changeStoreState($id);

        return redirect()->back();
    }

    public function setDefaultCurrency($id)
    {
        $store = $this->storeRepository->getActiveStore();
        $storeCurrencies = $this->storeCurrencyRepository->getStoreCurrenciesByStoreId($store->id);

        foreach ($storeCurrencies as $storeCurrency) {
            if ($storeCurrency->currency_id == $id) {
                Session::put('defaultCurrency', $this->currencyRepository->findById($id));
            }
        }

        return redirect()->back();
    }
}
