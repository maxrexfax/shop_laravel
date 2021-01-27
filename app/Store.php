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

    public function locales()
    {
        return $this->belongsToMany(Locale::class, 'store_locale', 'store_id', 'locale_id');
    }

    public function getLocales()
    {
        if (!empty($this->locales)) {
            return $this->locales;
        }

        return '';
    }
}
