<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promocode extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'promocode_name', 'promocode_value',
    ];
}
