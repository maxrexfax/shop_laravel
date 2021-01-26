<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Locale extends Model
{
    protected $fillable = [
        'locale_name', 'locale_code', 'locale_logo'
    ];
}
