<?php

namespace App\Http\Controllers;

use App\Currency;
use App\Delivery;
use App\Http\Requests\StoreStoreRequest;
use App\Locale;
use App\Services\StoreCurrencyStoreService;
use App\Services\StoreDeliveryStoreService;
use App\Services\StoreLocaleStoreService;
use App\Services\StoreStoreService;
use App\Store;
use App\StoreCurrency;
use App\StoreLocale;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function create($id = null)
    {
        if (!empty($id)) {
            $store = Store::find($id);
            if ($store) {
                return view ('admin.partials.store._store_edit_create', [
                    'store' => $store,
                ]);
            }

            return redirect('/admin/stores/list');
        }

        return view ('admin.partials.store._store_edit_create', [

        ]);
    }

    public function store($id = null, StoreStoreRequest $request)
    {
        $store = Store::find($id);

        if ($store) {
            (new StoreStoreService())->store($store ,$request);

            return redirect('/admin/stores/list');
        }

        $store = new Store();

        (new StoreStoreService())->store($store ,$request);

        return redirect('/admin/stores/list');
    }

    public function phoneList($id = null)
    {
        $store = Store::find($id);
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
        $store = Store::find($id);
        if ($store) {
            return view('admin.partials.locale._store_locale_list', [
                'store' => $store,
                'locales' => Locale::all(),
            ]);
        }
    }

    public function storeLocales($id, Request $request)
    {
        $store = Store::find($id);
        if ($store) {
            (new StoreLocaleStoreService())->store($store, $request);
        }

        return redirect()->back();
    }

    public function storeDelivery($id, Request $request)
    {
        $store = Store::find($id);
        if ($store) {
            (new StoreDeliveryStoreService())->store($store, $request);
        }

        return redirect()->back();
    }

    public function currencyList($id)
    {
        return view('admin.partials.currency._store_currency_list', [
            'store' => Store::find($id),
            'currencies' => Currency::all()
        ]);
    }

    public function deliveryList($id)
    {
        return view('admin.partials.delivery._store_delivery_list', [
            'store' => Store::find($id),
            'deliveries' => Delivery::all()
        ]);
    }

    public function storeCurrency($id, Request $request)
    {
        $store = Store::find($id);
        if ($store) {
            (new StoreCurrencyStoreService())->store($store, $request);
        }
        return redirect()->back();
    }

    public function changeActive($id)
    {

        $store = Store::find($id);

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

            $storeCurrency->default = 0;
            if ($storeCurrency->currency_id == $id) {
                $storeCurrency->default = 1;
            }
            $storeCurrency->save();
        }

        return redirect()->back();
    }

}
