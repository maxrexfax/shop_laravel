<?php

namespace App;

use App\Helpers\PriceHelper;
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

    public function currentPrice()
    {
        return (new PriceHelper())->getPriceWithSymbol($this->delivery_price);
    }
}
