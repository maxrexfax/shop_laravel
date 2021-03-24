<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $table = 'order_product';

    protected $fillable = [
        'order_id',
        'product_id',
        'products_quantity'
    ];

    public function products()
    {
        return $this->hasOne(Product::class);
    }

    public function productQuantity($order_id, $product_id)
    {
        return (OrderProduct::where('order_id', '=', $order_id)->where('product_id', 'id', $product_id))->products_quantity;
    }

}
