<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePhoneRequest;
use App\Phone;
use App\Services\PhoneStoreService;

class PhoneController extends Controller
{
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
