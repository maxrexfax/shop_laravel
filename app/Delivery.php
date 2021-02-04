<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    protected $fillable = [
        'delivery_name', 'delivery_description', 'delivery_price', 'active'
        ];

    public function stores()
    {
        return $this->belongsToMany(Store::class, 'store_delivery');
    }
}
