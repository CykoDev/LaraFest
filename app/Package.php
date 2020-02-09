<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $currencySymbol = 'Rs.';

    protected $fillable = [
        'name', 'price', 'description', 'data',
    ];

    public function getCurrencySymbolAttribute($value)
    {

        return $this->currencySymbol;
    }
}
