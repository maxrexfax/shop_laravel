<?php

namespace App;

use App\Helpers\PriceHelper;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public $user_id;
    public $product_rows;
    public $delivery_id;
    public $promocode_id;
    public $promocode_value;
    public $totalProducts;
    public $totalAmount;

    public function __construct(array $attributes = [])
    {
        $this->product_rows = [];
        parent::__construct($attributes);
    }

    public function calculatePrice($priceIn)
    {
        return (new PriceHelper())->calculate($priceIn);
    }

    public function getCurrencySymbol()
    {
        return (new PriceHelper())->getCurrentCurrencySymbol();
    }
}
