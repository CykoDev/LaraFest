<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Event extends Model
{
    use Sluggable;

    protected $defaultImage = 'defaultEvent.png';

    protected $fillable = [
        'title', 'event_date', 'photo_id', 'data', 'details', 'event_type_id',
    ];

    protected $casts = [
        'data' => 'array',
        'event_date' => 'datetime',
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
                'source' => 'title',
                'onUpdate' => true,
            ]
        ];
    }

    /*
    *--------------------------------------------------------------------------
    * Mutators | Accessors
    *--------------------------------------------------------------------------
    */

    public function getDefaultImageAttribute($value){

        return '/img/' . $this->defaultImage;
    }


    /*
    *--------------------------------------------------------------------------
    * CRUD Relations
    *--------------------------------------------------------------------------
    */

    public function users() {
        return $this->belongsToMany('App\User');
    }

    public function photo(){

        return $this->belongsTo('App\Photo');
    }

    public function type(){

        return $this->belongsTo('App\EventType', 'event_type_id');
    }
}
