<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    protected $table = 'order_statuses';

    protected $fillable = [
        'status_name', 'status_code', 'status_description',
    ];

}
