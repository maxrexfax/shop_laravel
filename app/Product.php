<?php

namespace App;

use App\Helpers\CurrentCurrencyHelper;
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

    public function getProductImages()
    {
        if ($this->images) {
            return $this->images;
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

    public function currentPrice()
    {
        $currentCurrency = (new CurrentCurrencyHelper())->getCurrentCurrency();
        return $this->price * $currentCurrency->currency_value . $currentCurrency->currency_symbol;
    }

}
