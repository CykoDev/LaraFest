<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use App\User;
class Event extends Model
{
    use Sluggable;

    protected $defaultImage = 'defaults/event.png';
    protected $imageFolder = 'events/';

    protected $currencySymbol = 'Rs.';

    protected $fillable = [
        'name', 'event_date', 'end_date', 'photo_id', 'data', 'details', 'event_type_id', 'price',
    ];

    protected $casts = [
        'data' => 'array',
        'event_date' => 'datetime',
        'end_date' => 'datetime',
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

    public function getCurrencySymbolAttribute($value)
    {
        return $this->currencySymbol;
    }

    public function getDefaultImageAttribute($value)
    {

        return '/img/' . $this->defaultImage;
    }

    public function getImageFolderAttribute($value)
    {

        return $this->imageFolder;
    }

    public function getPriceAttribute($value)
    {
        if ($this->discount) {
            if ($this->discount->expiry_at->isPast()) {
                $this->discount->delete();
            } else {
                return $value - ($value * $this->discount->amount / 100);
            }
        }
        return $value;
    }


    /*
    *--------------------------------------------------------------------------
    * CRUD Relations
    *--------------------------------------------------------------------------
    */

    public function users()
    {
        return $this->morphedByMany('App\User', 'eventable');
    }

    public function packages()
    {
        return $this->morphedByMany('App\Package', 'eventable');
    }

    public function photo()
    {

        return $this->belongsTo('App\Photo');
    }

    public function discount()
    {
        return $this->morphOne('App\Discount', 'discountable');
    }

    public function expense()
    {
        return $this->morphOne('App\Expense', 'expendable');
    }

    public function type()
    {

        return $this->belongsTo('App\EventType', 'event_type_id');
    }

    public function checkConflict($id) {
        $user = User::find($id);
        if ($user->events) {
            foreach ($user->events as $event) {
                if ($this->event_date->lte($event->end_date) && $this->end_date->gte($event->event_date)) {
                    if ($event->id != $this->id) return $event;
                }
            }
        }
        if ($user->package()->exists()) {
            foreach ($user->package->events()->where('user_id', $id)->get() as $event) {
                if ($this->event_date->lte($event->end_date) && $this->end_date->gte($event->event_date)) {
                    if ($event->id != $this->id) return $event;
                }
            }
        }
        return false;
    }
}
