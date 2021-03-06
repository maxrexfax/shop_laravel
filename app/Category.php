<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    const ASCENDING_TYPE_OF_SORT = 'asc';
    const DESCENDING_TYPE_OF_SORT = 'desc';

    protected $fillable = [
        'category_name', 'category_id', 'sort_number', 'category_description', 'category_logo'
    ];

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function childrenCategories()
    {
        return $this->hasMany(Category::class)->with('categories');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function getProducts()
    {
        if(!empty($this->products)) {
            return $this->products;
        }

        return '';
    }

    public function parentCategory()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function getParentCategoryName()
    {
        if ($this->parentCategory) {
            return $this->parentCategory->category_name;
        }

        return '';
    }

}
