<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    const ORDER_STATUS_CREATED = 1;
    const ORDER_STATUS_DONE = 2;
    const ORDER_STATUS_EDITED = 3;
    const ORDER_STATUS_DELETED = 4;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'telephone',
        'address',
        'address_additional',
        'city',
        'postcode',
        'country',
        'delivery_id',
        'payment_method_name',
        'payment_method_id',
        'order_statuses_id',
        'promocode_id'
    ];

    public function delivery()
    {
        return $this->belongsTo(Delivery::class);
    }

    public function getDelivery()
    {
        return !empty($this->delivery) ? $this->delivery : null;
    }

    public function getDeliveryName()
    {
        return !empty($this->delivery) ? $this->delivery->delivery_name : null;
    }

    public function getDeliveryId()
    {
        return !empty($this->delivery) ? $this->delivery->id : '';
    }

    public function getDeliveryPrice()
    {
        return !empty($this->delivery) ? $this->delivery->delivery_price : 0;
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_product');
    }

    public function orderProduct()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function status()
    {
        //return $this->hasOne(Status::class, 'id', 'order_statuses_id');//эквивалентно друг другу
        return $this->belongsTo(OrderStatus::class, 'order_statuses_id', 'id');
    }

    public function getStatus()
    {
        return !empty($this->status) ? $this->status : '0';
    }

    public function discount()
    {
        return $this->hasOne(Promocode::class, 'id', 'promocode_id');
    }

    public function getDiscount()
    {
        return !empty($this->discount) ? $this->discount->promocode_value : '0';
    }

    public function getPaymentMethodName()
    {
        $paymentMethod = PaymentMethod::where('payment_method_code', '=', $this->payment_method_code)->first();
        return !empty($paymentMethod) ? $paymentMethod->payment_method_name : trans('text.payment_method_not_exist');
    }

    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function getOrderProducts()
    {
        return !empty($this->orderProducts) ? $this->orderProducts : '';
    }

    public function getOrderPaymentDetails($order)
    {
        $paymentArray = [];
        if ($order->payment_method_code === PaymentMethod::PAYMENT_METHOD_CREDIT) {
            $paymentArray['paymentDetails'] = (CreditCard::find($order->payment_method_id))->credit_card_number;
            $paymentArray['paymentDescription'] = trans('text.credit_card_number');
        } else if ($order->payment_method_code === PaymentMethod::PAYMENT_METHOD_PAYPAL) {
            $paymentArray['paymentDetails'] = (PaypalPayment::find($order->payment_method_id)) ? (PaypalPayment::find($order->payment_method_id))->paypal_email : '';
            $paymentArray['paymentDescription'] = trans('text.paypal_method_details');
        } else if ($order->payment_method_code === PaymentMethod::PAYMENT_METHOD_CASH) {
            $paymentArray['paymentDetails'] = '';
            $paymentArray['paymentDescription'] = trans('text.cash_method_details');
        }
        return $paymentArray;
    }

}
