<?php

namespace App\Http\Controllers;

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

    public function create($store_id = null)
    {
        return view('admin.partials.phones._phone_edit_create', [
            'store' => $this->storeRepository->findById($store_id),
        ]);
    }

    public function edit($store_id = null, $phone_id = null)
    {
        $phone = $this->phoneRepository->findById($phone_id);

        if ($phone) {
            return view('admin.partials.phones._phone_edit_create', [
                'phone' => $phone,
                'store' => $this->storeRepository->findById($store_id)
            ]);
        }

        return redirect('/store/phonelist/' . $store_id);
    }

    public function store(StorePhoneRequest $request)
    {
        $this->phoneRepository->storePhone($request);

        return redirect('/store/phonelist/' . $request->post('store_id'));
    }

    public function update(StorePhoneRequest $request)
    {
        $this->phoneRepository->storePhone($request);

        return redirect('admin/category/list');
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
