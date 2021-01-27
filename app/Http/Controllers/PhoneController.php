<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePhoneRequest;
use App\Phone;
use App\Services\PhoneStoreService;

class PhoneController extends Controller
{
    public function create($store_id = null, $phone_id = null)
    {
        $phone = Phone::find($phone_id);
        $store = Phone::find($store_id);
        if ($phone) {
            return view('admin.partials.phones._phone_edit_create', [
                'alt_title' => 'Edit phone',
                'phone' => $phone,
                'store' => $store
            ]);
        }
        return view('admin.partials.phones._phone_edit_create', [
            'alt_title' => 'Create phone',
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

    public function store($id = null, StorePhoneRequest $request)
    {
        $phone = Phone::find($id);
        if (!$phone) {
            $phone = new Phone();
        }
        (new PhoneStoreService())->storePhone($request, $phone);

        return redirect()->back();
    }
}
