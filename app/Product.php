<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'product_name', 'rating', 'price', 'image', 'description', 'title', 'short_description', 'full_description',
    ];


    public function images()
    {
        return $this->hasMany('App\Image');
    }
}
