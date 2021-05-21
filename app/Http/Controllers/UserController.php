<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Repository\UserRepositoryInterface;
use App\User;
use Illuminate\Database\Eloquent\Model;
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
        return response()->json($this->userRepository->all(), 200);
    }

    public function create($id = null)
    {
        return view('admin.partials.user._user_edit_create');
    }

    public function edit($id = null)
    {
        if (empty($id)) {
            return redirect('/admin/users/list');
        }

        $user = $this->userRepository->findById($id);

        if ($user) {
            return view('admin.partials.user._user_edit_create', [
                'user' => $user,
            ]);
        }

        return redirect('/admin/users/list');
    }

    public function store(StoreUserRequest $request)
    {
        $user = new User();

        if ($user) {
            $this->userRepository->storeUser($request, $user);
        }

        return redirect('admin/users/list');
    }

    public function update($id = null, StoreUserRequest $request)
    {
        if (Auth::user()->isAdmin() || Auth::user()->id === (int)$id) {
            $user = null;
            if($id != null) {
                $user = $this->userRepository->findById($id);
            }

            if ($user == null) {
                $user = new User();
            }

            $this->userRepository->storeuser($request, $user);
        }

        return redirect('admin/users/list');
    }

    /**
     * @param $id
     * @return string
     */
    public function destroy($id)
    {
        $user = $this->userRepository->findById($id);
        if ($user) {
            $this->userRepository->destroy($id);
        }

        return back();
    }
}
