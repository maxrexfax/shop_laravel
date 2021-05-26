<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditPhoneRequest;
use App\Http\Requests\StorePhoneRequest;
use App\Repository\PhoneRepositoryInterface;
use App\Repository\StoreRepositoryInterface;

class PhoneController extends Controller
{
    protected $phoneRepository;
    protected $storeRepository;

    public function __construct(PhoneRepositoryInterface $phoneRepository, StoreRepositoryInterface $storeRepository)
    {
        $this->phoneRepository = $phoneRepository;
        $this->storeRepository = $storeRepository;
    }

    public function create(EditPhoneRequest $request)
    {
        return view('admin.partials.phones._phone_edit_create', [
            'store' => $this->storeRepository->findById($request->get('storeId')),
        ]);
    }

    public function edit(EditPhoneRequest $request)
    {
        return view('admin.partials.phones._phone_edit_create', [
            'phone' => $this->phoneRepository->findById($request->get('phoneId')),
            'store' => $this->storeRepository->findById($request->get('storeId'))
        ]);
    }

    public function store(StorePhoneRequest $request)
    {
        $this->phoneRepository->storePhone($request);

        return redirect('/store/phonelist?storeId=' . $request->post('storeId'));
    }

    public function update(StorePhoneRequest $request)
    {
        $this->phoneRepository->storePhone($request);

        return redirect('/store/phonelist?storeId=' . $request->post('storeId'));
    }

    public function destroy($id)
    {
        $phone = $this->phoneRepository->findById($id);

        if ($phone) {
            $this->phoneRepository->destroy($id);
        }

        return redirect()->back();
    }
}
