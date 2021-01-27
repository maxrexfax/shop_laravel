<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStoreRequest;
use App\Locale;
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
        StoreLocale::where('store_id', $store->id)->delete();
        if ($request->post('locales')) {

            StoreLocale::where('store_id', $store->id)->delete();

            foreach ($request->post('locales') as $locale) {
                $storeLocale = new StoreLocale();
                $storeLocale->store_id = $store->id;
                $storeLocale->locale_id = $locale;
                $storeLocale->save();
            }
        }
        return redirect()->back();
    }

}
