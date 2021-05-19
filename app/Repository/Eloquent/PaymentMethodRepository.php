<?php

namespace App\Repository\Eloquent;

use App\Helpers\ImageHelper;
use App\Image;
use App\PaymentMethod;
use App\Repository\PaymentMethodRepositoryInterface;

class PaymentMethodRepository extends BaseRepository implements PaymentMethodRepositoryInterface
{
    protected $model;

    public function __construct(PaymentMethod $model)
    {
        $this->model = $model;
    }

    public function store($request, $paymentMethod)
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