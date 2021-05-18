<?php

namespace App\Services;

use App\CreditCard;
use App\OrderProduct;
use App\PaymentMethod;
use App\PaypalPayment;
use Illuminate\Support\Facades\Auth;

class OrderStoreService
{
//    public function store($order, $request)
//    {
//        //dd($request->post());
//        $paying = null;
//
//        if ($request->post('payment_method_code') === PaymentMethod::PAYMENT_METHOD_CREDIT) {
//            $card = CreditCard::find($order->payment_method_id);
//            if ($card) {
//                $card->delete();
//            }
//            $paying = $this->createCreditCard($request);
//
//        } else if ($request->post('payment_method_code') === PaymentMethod::PAYMENT_METHOD_PAYPAL) {
//            $paypal = PaypalPayment::find($order->payment_method_id);
//            if ($paypal) {
//                $paypal->delete();
//            }
//            $paying = $this->createPaypalPayment($request);
//        }
//
//        if ($paying) {
//            $order->payment_method_id = $paying->id;
//        }
//
//        if ($request->post('payment_method_code') != 'defaultValue') {
//            $order->payment_method_code = $request->post('payment_method_code');
//        }
//
//        $order->first_name = $request->post('first_name');
//        $order->last_name = $request->post('last_name');
//        $order->email = $request->post('email');
//        $order->telephone = $request->post('telephone');
//        $order->address = $request->post('address');
//        $order->address_additional = $request->post('address_additional');
//        $order->city = $request->post('city');
//        $order->postcode = $request->post('postcode');
//        $order->country = $request->post('country');
//        $order->uniq_id = uniqid();
//        $order->delivery_id = $request->post('delivery_id') ? $request->post('delivery_id') : null;
//        $order->order_statuses_id = $request->post('order_statuses_id');
//        $order->promocode_id = $request->post('promocode_id');
//        $order->save();
//
//        //$order->getOrderProducts()->delete();//!!! need foreach to delete
//        OrderProduct::where('order_id', '=', $order->id)->delete();//no need foreach
//
//        if (!empty($request->post('products'))) {
//            $this->editOrderProducts($order, $request);
//        }
//
//        return $order;
//    }

//    private function createCreditCard($request)
//    {
//        $paying = new CreditCard();
//        $paying->card_type = $request->post('card_type');
//        $paying->credit_card_number = $request->post('credit_card_number');
//        $paying->expiration_year = $request->post('expiration_year');
//        $paying->expiration_month = $request->post('expiration_month');
//        $paying->card_verification_number = $request->post('card_verification_number');
//        $paying->save();
//        return $paying;
//    }
//
//    private function createPaypalPayment($request)
//    {
//        $paying = new PaypalPayment();
//        $paying->paypal_email = $request->post('paypal_email');
//        $paying->paypal_user_info = !empty(Auth::user()->login) ? Auth::user()->login : $request->post('paypal_email');
//        $paying->paypal_additional_info = 'Some data';
//        $paying->save();
//        return $paying;
//    }
//
//    private function editOrderProducts($order, $request)
//    {
//        foreach ($request->post('products') as $key => $product) {
//            $orderProduct = new OrderProduct();
//            $orderProduct->order_id = $order->id;
//            $orderProduct->product_id = $request->post('products')[$key];
//            $orderProduct->products_quantity = $request->post('quantity')[$key];
//            $orderProduct->save();
//        }
//    }
}