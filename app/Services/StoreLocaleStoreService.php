<?php

namespace App\Services;

use App\Store;
use App\StoreLocale;

class StoreLocaleStoreService
{
//    public function store($request)
//    {
//        $store = Store::find($request->post('storeId'));
//
//        if ($request->post('locales')) {
//
//            StoreLocale::where('store_id', $store->id)->delete();
//
//            foreach ($request->post('locales') as $locale) {
//
//                $storeLocale = new StoreLocale();
//                if ($locale===$request->post('default')) {
//                    $storeLocale->default = 1;
//                }
//                $storeLocale->store_id = $store->id;
//                $storeLocale->locale_id = $locale;
//                $storeLocale->save();
//            }
//        }
//    }
}
