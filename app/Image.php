<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class Image extends Model
{
    public const PATH_TO_SAVE_PRODUCT_IMAGES = '/img/images/';
    public const PATH_TO_SAVE_LOGOS = '/img/logo/';
    protected $fillable = [
        'image_name',
    ];

    public function products()
    {
        return $this->belongsToMany('App\Product');
    }
}
