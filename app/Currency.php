<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    const IS_DEFAULT_CURRENCY = 1;
    protected $fillable = [
        'currency_name', 'currency_code', 'currency_value'
    ];

    public function isDefault($store_id)
    {
        $storeCurrency = StoreCurrency::where('store_id', $store_id)->where('currency_id', $this->id)->first();

        return $storeCurrency->isDefault();
    }

}
