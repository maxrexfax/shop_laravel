<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    const STORE_IS_ACTIVE = 1;

    protected $fillable = [
        'store_name', 'store_description', 'store_logo', 'store_keywords'
    ];

    public function phones()
    {
        return $this->hasMany(Phone::class);
    }

    public function getPhones()
    {
        return $this->phones ? : '';
    }

    public function locales()
    {
        return $this->belongsToMany(Locale::class, 'store_locale', 'store_id', 'locale_id');
    }

    public function getLocales()
    {
        return $this->locales ? : '';
    }

    public function storeCurrencies()
    {
        return $this->hasMany(StoreCurrency::class, 'store_id', 'id');
    }

    public function getActiveStoreCurrency()
    {
        return $this->storeCurrencies->where('default', '=', Store::STORE_IS_ACTIVE)->first();
    }

    public function getDefaultCurrency()
    {
        $storeCurrency = $this->getActiveStoreCurrency();//if StoreCurrency is not set!
        if (isset($storeCurrency)) {
            return Currency::findOrFail($this->getActiveStoreCurrency()->currency_id);
        }
        return Currency::find(1);
    }

    public function currencies()
    {
        return $this->belongsToMany(Currency::class, 'store_currency', 'store_id', 'currency_id');
    }

    public function getCurrencies()
    {
        return $this->currencies ? $this->currencies : '';
    }


    public function getDefaultLocale()
    {
        return $this->defaultLocale ? : '';
    }

    public function storeLocales()
    {
        return $this->hasMany(StoreLocale::class, 'store_id', 'id');
    }

    public function deliveries()
    {
        return $this->belongsToMany(Delivery::class, 'store_delivery');
    }
}
