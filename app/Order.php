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
        return $this->hasOne(Delivery::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'order_id', 'id');
    }

    public function orderProduct($pro)
    {

    }
}
