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

    public function store($promocode, $request)
    {
        $promocode->fill($request->post());
        $promocode->save();
    }

}