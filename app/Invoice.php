<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Invoice extends Model
{
    protected $fillable = [
        'user_id', 'total', 'path',
    ];

    protected $public_path = '/img/invoices/';

    public function getPathAttribute($value)
    {

        return $this->public_path . $value;
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
