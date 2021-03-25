<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
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
    ];

    public function delivery()
    {
        return $this->belongsTo(Delivery::class);
    }

    public function getDeliveryName()
    {
        return !empty($this->delivery) ? $this->delivery->delivery_name : null;
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
}
