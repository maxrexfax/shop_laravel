<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $fillable = [
        'store_name', 'store_description', 'store_logo', 'store_keywords'
    ];

    public function phones()
    {
        return $this->hasMany(Phone::class);
    }

    public function getPhones()
    {
        if(!empty($this->phones)) {
            return $this->phones;
        }

        return '';
    }

}
