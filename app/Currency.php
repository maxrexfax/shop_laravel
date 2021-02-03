<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    const IS_DEFAULT_CURRENCY = 1;
    const CURRENCY_MAIN = 'USD';
    const CURRENCY_DOLLAR = 'USD';
    const CURRENCY_HRYVNA = 'UAH';
    const CURRENCY_EURO = 'EUR';

    protected $fillable = [
        'currency_name', 'currency_code', 'currency_value', 'currency_symbol'
    ];

    public function isDefault($store_id)
    {
        $storeCurrency = StoreCurrency::where('store_id', $store_id)->where('currency_id', $this->id)->first();

        return $storeCurrency->isDefault();
    }

}
