<?php

namespace App\Repository\Eloquent;

use App\Store;
use App\Repository\StoreRepositoryInterface;

class StoreRepository extends BaseRepository implements StoreRepositoryInterface
{
    protected $model;

    public function __construct(Store $model)
    {
        $this->model = $model;
    }

    public function paginateModel(int $numberToShow)
    {
        return Store::paginate($numberToShow);
    }

    public function getActiveStore()
    {
        return Store::firstWhere('active', '=', Store::STORE_IS_ACTIVE);
    }

    public function changeStoreState($id)
    {
        $store = $this->model->find($id);
        $store->active = !$store->active;
    }

    public function store($request)
    {
        $logo = null;
        $store = $this->model->findById($request->post('id'));
        if (empty($store)) {
            $store = new Store();
        }
        if ($store->store_logo) {
            $logo = $store->store_logo;
        }

        $store->fill($request->post());

        if ($request->has('store_logo')) {
            $image = $request->file('store_logo');
            $store->store_logo = $image->getClientOriginalName();
            $image->move(public_path('img/logo'), $image->getClientOriginalName());
        } else {
            $store->store_logo = $logo;
        }

        $store->save();
    }
}


