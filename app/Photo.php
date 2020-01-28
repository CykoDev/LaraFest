<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    //

    protected $path = '/img/';

    protected $fillable = [
        'path', 'type',
    ];

    public function getFileAttribute($value){

        return $this->path . $value;
    }

}
