<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //

    protected $userCount;

    public function users(){

        return $this->hasMany('App\User');
    }

    public function  getUserCountAttribute(){
        return $this->users()->count();
    }
}
