<?php

namespace App;

use App\Helpers\PriceHelper;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'product_name', 'rating', 'price', 'logo_image', 'description', 'title', 'short_description', 'full_description'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasMany('App\Image');
    }

    /**
     * @return mixed|string
     */
    public function getProductImages()
    {
        if ($this->images) {
            return $this->images;
        }

        return '';
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_product', 'product_id', 'category_id' );
    }

    /**
     * @return array|mixed
     */
    public function getProductCategories()
    {
        if (!empty($this->categories)) {
            return $this->categories;
        }

        return [];
    }

    /**
     * @return string
     */
    public function currentPrice()
    {
        return (new PriceHelper())->getPriceWithSymbol($this->price);
    }

    public function order()
    {
        return $this->belongsToMany(Order::class, 'order_product', 'product_id', 'order_id');
    }

    public function orderProduct($order_id)
    {
        return OrderProduct::where('product_id', '=', $this->id)->where('order_id', '=', $order_id)->first();
    }

}
