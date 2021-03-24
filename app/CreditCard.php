<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CreditCard extends Model
{
    protected $fillable = [
        'card_type', 'credit_card_number', 'expiration_year', 'expiration_month', 'card_verification_number'
    ];
}
