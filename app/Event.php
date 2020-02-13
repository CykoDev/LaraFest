<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Event extends Model
{
    use Sluggable;

    protected $defaultImage = 'defaults/event.png';
    protected $imageFolder = 'events/';

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

    public function getImageFolderAttribute($value){

        return $this->imageFolder;
    }


    /*
    *--------------------------------------------------------------------------
    * CRUD Relations
    *--------------------------------------------------------------------------
    */

    public function users() {
        return $this->morphedByMany('App\User', 'eventable');
    }

    public function packages() {
        return $this->morphedByMany('App\Package', 'eventable');
    }

    public function photo(){

        return $this->belongsTo('App\Photo');
    }

    public function discount() {
        return $this->morphOne('App\Discount', 'discountable');
    }

    public function type(){

        return $this->belongsTo('App\EventType', 'event_type_id');
    }
}
