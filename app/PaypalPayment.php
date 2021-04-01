<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaypalPayment extends Model
{
    protected $table = 'paypal_info';

    protected $fillable = [
        'paypal_email', 'paypal_user_info', 'paypal_additional_info'
    ];
}
