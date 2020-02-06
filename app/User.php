<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Cviebrock\EloquentSluggable\Sluggable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use Sluggable;

    protected $defaultImage = 'defaultUser.png';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id', 'is_active', 'photo_id', 'profile_completed_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name',
                'onUpdate' => true,
            ]
        ];
    }

    /*
    *--------------------------------------------------------------------------
    * Middleware Functions
    *--------------------------------------------------------------------------
    */

    public function isAdmin() {

        if($this->role){

            if($this->role->name == 'admin' && $this->is_active == 1){

                return true;
            }
            return false;
        }
        else {
            return false;
        }
    }

    public function isModerator() {

        if($this->role){

            if($this->role->name == 'moderator' && $this->is_active == 1){

                return true;
            }
            return false;
        }
        else {
            return false;
        }
    }

    public function isMonitor() {

        if($this->role){

            if($this->role->name == 'monitor' && $this->is_active == 1){

                return true;
            }
            return false;
        }
        else {
            return false;
        }
    }

    public function isApplicant() {

        if($this->role){

            if($this->role->name == 'applicant' && $this->is_active == 1){

                return true;
            }
            return false;
        }
        else {
            return false;
        }
    }


    /*
    *--------------------------------------------------------------------------
    * Mutators | Accessors
    *--------------------------------------------------------------------------
    */

    public function getDefaultImageAttribute($value){

        return '/img/' . $this->defaultImage;
    }

    public function setPasswordAttribute($value){

        $this->attributes['password'] = Hash::make($value);
    }

    /*
    *--------------------------------------------------------------------------
    * CRUD Relations
    *--------------------------------------------------------------------------
    */

    public function role(){

        return $this->belongsTo('App\Role');
    }

    public function photo(){

        return $this->belongsTo('App\Photo');
    }

    public function events(){
        return $this->belongsToMany('App\Event');
    }
}
