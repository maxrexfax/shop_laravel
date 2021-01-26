<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStoreRequest;
use App\Services\StoreStoreService;
use App\Store;

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
            return view('admin.partials.store._store_phones', [
                'alt_title' => 'Save store phones list',
                'store' => $store,
                'phones' => $store->getPhones(),
            ]);
        }

        return redirect('/admin/stores/list');
    }

}
