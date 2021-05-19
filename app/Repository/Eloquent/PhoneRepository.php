<?php

namespace App\Repository\Eloquent;

use App\Http\Requests\StorePhoneRequest;
use App\Phone;
use App\Repository\PhoneRepositoryInterface;

class PhoneRepository extends BaseRepository implements PhoneRepositoryInterface
{
    protected $model;

    public function __construct(Phone $model)
    {
        $this->model = $model;
    }

    public function storePhone($request, $phone)
    {
        $phone->phone_number = $request->post('phone_number');
        $phone->phone_info = $request->post('phone_info');
        $phone->store_id = $request->post('store_id');
        $phone->save();
    }

}