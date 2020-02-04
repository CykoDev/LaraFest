<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{


    /*
    *--------------------------------------------------------------------------
    * CRUD Relations
    *--------------------------------------------------------------------------
    */

    public function users() {
        return $this->belongsToMany('App\User');
    }
}
