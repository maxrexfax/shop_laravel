<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditUserRequest;
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

    public function create()
    {
        return view('admin.partials.user._user_edit_create');
    }

    public function edit(EditUserRequest $request)
    {
        return view('admin.partials.user._user_edit_create', [
            'user' => $this->userRepository->findById($request->get('id')),
        ]);
    }

    public function store(StoreUserRequest $request)
    {
        $this->userRepository->storeUser($request);

        return redirect('admin/users/list');
    }

    public function update(StoreUserRequest $request)
    {
        if (Auth::user()->isAdmin() || Auth::user()->id === (int)$request->post('id')) {
            $this->userRepository->storeuser($request);
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
