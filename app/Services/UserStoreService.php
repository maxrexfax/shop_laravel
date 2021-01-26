<?php

namespace App\Services;

use Illuminate\Support\Facades\Hash;

class UserStoreService
{
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
