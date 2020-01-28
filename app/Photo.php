<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    //

    protected $public_path = '/img/';

    protected $fillable = [
        'path', 'type',
    ];

    public function getPathAttribute($value){

        return $this->public_path . $value;
    }

}
