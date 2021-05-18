<?php

namespace App\Repository\Eloquent;

use App\User;
use Illuminate\Support\Facades\Hash;
use App\Repository\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function storeUser($request, $user)
    {
        $user->login = $request->post('login');
        $user->password = Hash::make( $request->post('password'));
        $user->first_name = $request->post('first_name');
        $user->second_name = $request->post('second_name');
        $user->last_name = $request->post('last_name');
        $user->email = $request->post('email');
        $user->save();
    }

}