<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryProduct extends Model
{
    protected $table = 'category_product';

    public function products()
    {
        return $this->hasOne(Product::class);
    }
}
