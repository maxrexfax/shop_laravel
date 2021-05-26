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

    public function paginateModel(int $numberToShow)
    {
        return Phone::paginate($numberToShow);
    }

    public function storePhone($request)
    {
        $phone = $this->model->find($request->post('phoneId'));
        if (empty($phone)) {
            $phone = new Phone();
        }
        $phone->phone_number = $request->post('phone_number');
        $phone->phone_info = $request->post('phone_info');
        $phone->store_id = $request->post('storeId');
        $phone->save();
    }

}