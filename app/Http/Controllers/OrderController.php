<?php

namespace App\Http\Controllers;

use App\CreditCard;
use App\Order;
use App\PaymentMethod;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $paying = null;
        if ($request->post('payment_method_name') === PaymentMethod::PAYMENT_METHOD_CREDIT) {
            $paying = new CreditCard();
            $paying->card_type = $request->post('card_type');
            $paying->credit_card_number = $request->post('credit_card_number');
            $paying->expiration_year = $request->post('expiration_year');
            $paying->expiration_month = $request->post('expiration_month');
            $paying->card_verification_number = $request->post('card_verification_number');
            $paying->save();
        }
        $order = new Order();
        $order->first_name = $request->post('first_name');
        $order->last_name = $request->post('last_name');
        $order->email = $request->post('email');
        $order->telephone = $request->post('telephone');
        $order->address = $request->post('address');
        $order->address_additional = $request->post('address_additional');
        $order->city = $request->post('city');
        $order->postcode = $request->post('postcode');
        $order->country = $request->post('country');
        $order->delivery_id = $request->post('delivery_id');
        $order->payment_method_name = $request->post('payment_method_name');
        $order->payment_method_id = 0;
        $order->save();
dd($request->post());
        //return back();
    }
}
