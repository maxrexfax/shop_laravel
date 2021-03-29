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
        'statuses_id',
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
        //return $this->hasOne(Status::class, 'id', 'statuses_id');//эквивалентно друг другу
        return $this->belongsTo(Status::class, 'statuses_id', 'id');
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


}
