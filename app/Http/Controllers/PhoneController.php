<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePhoneRequest;
use App\Phone;
use App\Repository\PhoneRepositoryInterface;
use App\Services\PhoneStoreService;
use App\Store;
use Illuminate\Database\Eloquent\Model;

class PhoneController extends Controller
{
    private $phoneRepository;

    public function __construct(PhoneRepositoryInterface $phoneRepository)
    {
        $this->phoneRepository = $phoneRepository;
    }

    public function create($store_id = null)
    {
        return view('admin.partials.phones._phone_edit_create', [
            'store' => Store::find($store_id),
        ]);
    }

    public function edit($store_id = null, $phone_id = null)
    {
        $phone = $this->phoneRepository->findById($phone_id);

        if ($phone) {
            return view('admin.partials.phones._phone_edit_create', [
                'phone' => $phone,
                'store' => Store::find($store_id)
            ]);
        }

        return redirect('/store/phonelist/' . $store_id);
    }

    public function store(StorePhoneRequest $request)
    {
        $phone = new Phone();

        $this->phoneRepository->storePhone($request, $phone);

        return redirect('/store/phonelist/' . $request->post('store_id'));
    }

    public function update($id = null, StorePhoneRequest $request)
    {
        $phone = $this->phoneRepository->findById($id);

        if ($phone) {
            $this->phoneRepository->storePhone($request, $phone);
        }

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
