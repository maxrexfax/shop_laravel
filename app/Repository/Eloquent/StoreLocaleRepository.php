<?php

namespace App\Repository\Eloquent;

use App\Repository\StoreLocaleRepositoryInterface;
use App\Store;
use App\StoreLocale;
use Illuminate\Database\Eloquent\Model;

class StoreLocaleRepository extends BaseRepository implements StoreLocaleRepositoryInterface
{
    protected $model;

    public function __construct(StoreLocale $model)
    {
        $this->model = $model;
    }

    public function store($request)
    {
        if ($request->post('locales')) {

            StoreLocale::where('store_id', $request->post('storeId'))->delete();

            foreach ($request->post('locales') as $locale) {

                $storeLocale = new StoreLocale();
                if ($locale===$request->post('default')) {
                    $storeLocale->default = 1;
                }
                $storeLocale->store_id = $request->post('storeId');
                $storeLocale->locale_id = $locale;
                $storeLocale->save();
            }
        }
    }

}