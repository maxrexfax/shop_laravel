<?php

namespace App\Http\Controllers;

use App\Currency;
use App\Http\Requests\StoreStoreRequest;
use App\Locale;
use App\Services\StoreCurrencyStoreService;
use App\Services\StoreLocaleStoreService;
use App\Services\StoreStoreService;
use App\Store;
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
                    'alt_title' => 'Edit store ' . $store->store_name
                ]);
            } else {
                return redirect('/admin/stores/list');
            }

        } else {
            return view ('admin.partials.store._store_edit_create', [
                'alt_title' => 'Create new store'
            ]);
        }
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
                'alt_title' => 'Save store phones list',
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

    public function currencyList($id)
    {
        $store = Store::find($id);
        return view('admin.partials.currency._store_currency_list', [
            'store' => $store,
            'currencies' => Currency::all()
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
            if($store->active == null) {
                $store->active = 1;
            } else {
                $store->active = null;
            }
            $store->save();
        }

        return redirect()->back();
    }

}
