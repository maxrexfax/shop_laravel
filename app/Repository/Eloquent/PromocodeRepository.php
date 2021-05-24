<?php

namespace App\Repository\Eloquent;

use App\Promocode;
use App\Repository\PromocodeRepositoryInterface;

class PromocodeRepository extends BaseRepository implements PromocodeRepositoryInterface
{
    protected $model;

    public function __construct(Promocode $model)
    {
        $this->model = $model;
    }

    public function paginateModel(int $numberToShow)
    {
        return Promocode::paginate($numberToShow);
    }

    public function store($request)
    {
        $promocode = $this->model->find($request->post('id'));

        if (empty($promocode)) {
            $promocode = new Promocode();
        }

        $promocode->fill($request->post());
        $promocode->save();
    }

}