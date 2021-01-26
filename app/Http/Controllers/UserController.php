<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Role;
use App\Services\UserStoreService;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id = null)
    {
        if (!empty($id)) {
            $user = User::find($id);
            if ($user) {
                return view('admin.partials.user._user_edit_create', [
                    'alt_title' => 'Edit user ' . $user->login,
                    'user' => $user,
                ]);
            } else {
                return redirect('/admin/users/list');
            }
        } else {
            return view('admin.partials.user._user_edit_create', [
                'alt_title' => 'Create new user'
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id = null, StoreUserRequest $request)
    {
        if (Auth::user()->isAdmin() || Auth::user()->id === (int)$id) {

            $user = User::find($id);

            if ($user) {
                (new UserStoreService())->storeUser($request, $user);

                return redirect('admin/users/list');
            }

            $user = new User();

            (new UserStoreService())->storeuser($request, $user);

        }
        return redirect('admin/users/list');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return 'Delete user with id='. $id;
    }
}
