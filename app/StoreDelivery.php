<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StoreDelivery extends Model
{
    protected $table = 'store_delivery';

    protected $fillable = [
        'store_id', 'delivery_id',
    ];
}
