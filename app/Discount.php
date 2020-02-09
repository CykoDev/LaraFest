<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $fillable = [
        'package_id', 'name', 'amount', 'expiry_at', 'data',
    ];
}
