<?php

namespace App\Services;

use App\Helpers\ImageHelper;
use App\Image;

class PaymentMethodStoreService
{
    public function store($paymentMethod, $request)
    {
        $paymentMethod->payment_method_name = $request->post('payment_method_name');
        $paymentMethod->payment_method_code = $request->post('payment_method_code');
        $paymentMethod->other_data = $request->post('other_data');
        if ($request->has('logo')) {
            if ($paymentMethod->logo) {
                (new ImageHelper())->deleteImage($paymentMethod->logo, Image::PATH_TO_SAVE_LOGOS);
            }

            $image = $request->file('logo');
            $paymentMethod->logo = $image->getClientOriginalName();
            (new ImageHelper())->storeImageFile($image, '/img/logo/');
        }
        $paymentMethod->save();
    }
}