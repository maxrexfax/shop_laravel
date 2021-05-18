<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Repository\UserRepositoryInterface;
use App\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    private $userRepository;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->middleware('auth');
        $this->userRepository = $userRepository;
    }

    /**
     * Display the JSON listing of the users list.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        //return response()->json("Data1:1, Data2:2", 200);
        return response()->json($this->userRepository->all(), 200);
    }

    /**
     *  Create new or edit existing User
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
     * Store User function in controller
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

            $this->userRepository->storeuser($request, $user);
            //(new UserStoreService())->storeuser($request, $user);
        }
        return redirect('admin/users/list');
    }


    /**
     * @param $id
     * @return string
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
        }

        return back();
    }
}
