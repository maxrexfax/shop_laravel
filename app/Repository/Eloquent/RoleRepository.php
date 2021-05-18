<?php

namespace App\Repository\Eloquent;

use App\Role;
use App\Repository\RoleRepositoryInterface;

class RoleRepository extends BaseRepository implements RoleRepositoryInterface
{
    protected $model;

    public function __construct(Role $model)
    {
        $this->model = $model;
    }



}