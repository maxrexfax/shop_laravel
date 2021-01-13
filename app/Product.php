<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'product_name', 'rating', 'price', 'logo_image', 'description', 'title', 'short_description', 'full_description'
    ];

    public function images()
    {
        return $this->hasMany('App\Image');
    }

    public function getProductImage()
    {
        if ($this->images) {
            return $this->images->category_name;
        }

        return '';
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_product', 'product_id', 'category_id' );
    }

    public function getProductCategories()
    {
        if (!empty($this->categories)) {
            return $this->categories;
        }

        return [];
    }

}