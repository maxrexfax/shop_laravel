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
     * @param null $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function create($id = null)
    {
        if (!empty($id)) {
            $user = User::find($id);
            if ($user) {
                return view('admin.partials.user._user_edit_create', [
                    'user' => $user,
                ]);
            }

            return redirect('/admin/users/list');

        }

        return view('admin.partials.user._user_edit_create');
    }

    /**
     * @param null $id
     * @param StoreUserRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store($id = null, StoreUserRequest $request)
    {
        if (Auth::user()->isAdmin() || Auth::user()->id === (int)$id) {

            $user = User::find($id);

            if (!$user) {
                $user = new User();
            }

            (new UserStoreService())->storeuser($request, $user);
        }
        return redirect('admin/users/list');
    }


    /**
     * @param $id
     * @return string
     */
    public function destroy($id)
    {
        return 'Delete user with id='. $id;
    }
}
