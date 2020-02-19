<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Cviebrock\EloquentSluggable\Sluggable;
use Staudenmeir\EloquentJsonRelations\HasJsonRelationships;

use App\Photo;
use App\EventType;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use Sluggable;
    use HasJsonRelationships;

    protected $defaultImage = 'defaults/user.png';
    protected $imageFolder = 'users/';
    protected $accomodationPrice = 1200;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id', 'is_active', 'photo_id',
        'payment_status', 'invoice_proof_id', 'profile_completed_at', 'data', 'package_id'
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
        'data' => 'array',
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
    * Mutators | Accessors
    *--------------------------------------------------------------------------
    */

    public function getDefaultImageAttribute($value)
    {

        return '/img/' . $this->defaultImage;
    }

    public function getAccomodationPrice($value)
    {

        return $this->accomodationPrice;
    }

    public function getImageFolderAttribute($value)
    {

        return $this->imageFolder;
    }

    public function setPasswordAttribute($value)
    {

        $this->attributes['password'] = Hash::make($value);
    }

    /*
    *--------------------------------------------------------------------------
    * CRUD Relations
    *--------------------------------------------------------------------------
    */

    public function role()
    {

        return $this->belongsTo('App\Role');
    }

    public function package()
    {

        return $this->belongsTo('App\Package');
    }

    public function expenses()
    {
        return $this->hasMany('App\Expense');
    }

    public function invoice()
    {

        return $this->belongsTo('App\Invoice');
    }

    public function photo($photo = null)
    {
        if (isset($photo)) {
            if (isset($this->data[$photo . '_id'])) {
                return Photo::whereId($this->data[$photo . '_id'])->firstOrFail();
            } else {
                return null;
            }
        }
        return $this->belongsTo('App\Photo');
    }

    public function invoiceProof()
    {
        return $this->belongsTo('App\Photo', 'invoice_proof_id');
    }

    public function events($eventType = null)
    {
        if (isset($eventType)) {
            return EventType::whereName($eventType)->firstOrFail()->events();
        }
        return $this->morphToMany('App\Event', 'eventable');
    }

    /*
    *--------------------------------------------------------------------------
    * Middleware Functions
    *--------------------------------------------------------------------------
    */

    public function isAdmin()
    {

        if ($this->role) {

            if ($this->role->name == 'admin' && $this->is_active == 1) {

                return true;
            }
            return false;
        } else {
            return false;
        }
    }

    public function isModerator()
    {

        if ($this->role) {

            if ($this->role->name == 'moderator' && $this->is_active == 1) {

                return true;
            }
            return false;
        } else {
            return false;
        }
    }

    public function isMonitor()
    {

        if ($this->role) {

            if ($this->role->name == 'monitor' && $this->is_active == 1) {

                return true;
            }
            return false;
        } else {
            return false;
        }
    }

    public function isApplicant()
    {

        if ($this->role) {

            if ($this->role->name == 'applicant' && $this->is_active == 1) {

                return true;
            }
            return false;
        } else {
            return false;
        }
    }
}
