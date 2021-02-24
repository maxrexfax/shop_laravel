<?php

namespace App;

use App\Helpers\PriceHelper;
use Illuminate\Database\Eloquent\Model;

class Cart
{
    public $userId;
    public $productRows = [];
    public $deliveryId;
    public $promocodeId;
    public $promocodeValue;
    public $totalProducts;
    public $totalAmount;
    public $priceHelper;

    public function __construct()
    {
        $this->priceHelper = new PriceHelper();
    }

    public function calculatePrice($priceIn)
    {
        return $this->priceHelper->calculate($priceIn);
    }

    public function getCurrencySymbol()
    {
        return $this->priceHelper->getCurrentCurrencySymbol();
    }
}
