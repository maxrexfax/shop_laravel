<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePhoneRequest;
use App\Phone;
use App\Repository\PhoneRepositoryInterface;
use App\Services\PhoneStoreService;
use App\Store;

class PhoneController extends Controller
{
    private $phoneRepository;

    public function __construct(PhoneRepositoryInterface $phoneRepository)
    {
        $this->phoneRepository = $phoneRepository;
    }
    /**
     * Create new or edit existing Phone
     * @param null $phone_id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create($store_id = null, $phone_id = null)
    {
        $store = Store::find($store_id);
        $phone = Phone::find($phone_id);
        if ($phone) {
            return view('admin.partials.phones._phone_edit_create', [
                'phone' => $phone,
                'store' => $store
            ]);
        }

        return view('admin.partials.phones._phone_edit_create', [
            'store' => $store
        ]);
    }

    public function destroy($id)
    {
        $phone = Phone::find($id);

        if ($phone) {
            $phone->delete();
        }

        return redirect()->back();
    }

    /**
     * Store Phone function in controller
     * @param null $id
     * @param StorePhoneRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store($id = null, StorePhoneRequest $request)
    {
        $phone = Phone::find($id);

        if (!$phone) {
            $phone = new Phone();
        }

        $this->phoneRepository->storePhone($request, $phone);
        //(new PhoneStoreService())->storePhone($request, $phone);

        return redirect('/store/phonelist/' . $request->post('store_id'));
    }
}
