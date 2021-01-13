<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'category_name', 'category_id', 'sort_number', 'description', 'category_logo'
    ];

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function childrenCategories()
    {
        return $this->hasMany(Category::class)->with('categories');
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
