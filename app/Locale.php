<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Locale extends Model
{
    protected $fillable = [
        'locale_name', 'locale_code', 'locale_logo'
    ];

    public function storeLocale($id)
    {
        return $this->hasOne(StoreLocale::class,  'id', 'locale_id');
    }

    public function isDefault($store_id)
    {
        $storeLocale = StoreLocale::where('store_id', $store_id)->where('locale_id', $this->id)->first();

        return $storeLocale->isDefault();
    }
}
