<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $fillable = [
        'package_id', 'name', 'amount', 'expiry_at', 'data',
    ];

    public function discountable()
    {
        return $this->morphTo();
    }

    public function events() {
        return $this->belongsToMany('App\Event');
    }

    public function packages() {
        return $this->belongsToMany('App\Package');
    }
}
