<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StoreLocale extends Model
{
    protected $table = 'store_locale';

    protected $fillable = [
        'store_id', 'locale_id',
    ];

    public function locales()
    {
        return $this->hasOne(Locale::class);
    }

    public function localesList()
    {
        return $this->hasMany(Locale::class);
    }
}
