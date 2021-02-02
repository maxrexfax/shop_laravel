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

    public function currencies()
    {
        return $this->belongsToMany(Currency::class, 'store_currency', 'store_id', 'currency_id');
    }

    public function getCurrencies()
    {
        if (!empty($this->currencies)) {
            return $this->currencies;
        }

        return '';
    }

    public function defaultCurrency()
    {
        $storeCurrency = StoreCurrency::where('store_id', $this->id)->where('default', '=', 1)->get();
        return Currency::find($storeCurrency[0]->currency_id);
    }

    public function getDefaultLocale()
    {
        if (!empty($this->defaultLocale)) {
            return $this->defaultLocale;
        }

        return '';
    }

    public function storeLocales()
    {
        return $this->hasMany(StoreLocale::class, 'store_id', 'id');
    }
}
