<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StoreCurrency extends Model
{
    protected $table = 'store_currency';

    protected $fillable = [
        'store_id', 'currency_id', 'default'
    ];

    public function isDefault()
    {
        if ($this->default) {
            return true;
        }

        return false;
    }

    public function getDefaultCurrency($store_id)
    {
        return $this->hasOne(Currency::class)->where('store_id');
    }

    public function getCurrency()
    {
        return $this->hasOne(Currency::class);
    }
}
