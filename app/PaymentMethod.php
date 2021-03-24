<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    protected $fillable = [
            'payment_method_name', 'other_data', 'payment_method_code', 'logo'
        ];
}
