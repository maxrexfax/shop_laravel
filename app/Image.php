<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class Image extends Model
{
    protected $fillable = [
        'image_name',
    ];

    public function products()
    {
        return $this->belongsToMany('App\Product');
    }
}
