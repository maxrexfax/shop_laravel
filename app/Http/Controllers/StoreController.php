<?php

namespace App\Http\Controllers;

use App\Currency;
use App\Delivery;
use App\Helpers\PriceHelper;
use App\Http\Requests\StoreDeliveryStoreRequest;
use App\Http\Requests\StoreStoreRequest;
use App\Locale;
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
    private $storeRepository;

    public function __construct(StoreRepositoryInterface $storeRepository)
    {
        $this->storeRepository = $storeRepository;
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
        $store = new Store();

        $this->storeRepository->store($request, $store);

        return redirect('/admin/stores/list');
    }

    public function update($id = null, StoreStoreRequest $request)
    {
        $store = null;
        if($id != null) {
            $store = $this->storeRepository->findById($id);
        }

        if ($store) {
            $this->storeRepository->store($request, $store);
        }

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
                'locales' => Locale::all(),
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
            'currencies' => Currency::all()
        ]);
    }

    public function deliveryList($id)
    {
        return view('admin.partials.delivery._store_delivery_list', [
            'store' => $this->storeRepository->findById($id),
            'deliveries' => Delivery::all()
        ]);
    }

    public function storeCurrency($id, Request $request)
    {
        $store = $this->storeRepository->findById($id);

        if ($store) {
            (new StoreCurrencyStoreService())->store($store, $request);
        }

        return redirect()->back();
    }

    public function changeActive($id)
    {
        $store = $this->storeRepository->findById($id);

        if ($store) {
            $store->active = !$store->active;
            $store->save();
        }

        return redirect()->back();
    }

    public function setDefaultCurrency($id)
    {
        $store = Store::where('active', '=', Store::STORE_IS_ACTIVE)->first();
        $storeCurrencies = StoreCurrency::where('store_id', '=', $store->id)->get();

        foreach ($storeCurrencies as $storeCurrency) {
            if ($storeCurrency->currency_id == $id) {
                Session::put('defaultCurrency', Currency::find($id));
            }
        }

        return redirect()->back();
    }
}
