<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    const PAYMENT_METHOD_CREDIT = 'credit';
    const PAYMENT_METHOD_PAYPAL = 'paypal';
    const PAYMENT_METHOD_CASH = 'cash';

    protected $fillable = [
            'payment_method_name', 'other_data', 'payment_method_code', 'logo'
        ];
}
