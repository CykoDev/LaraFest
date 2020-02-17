<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Package extends Model
{
    use Sluggable;

    protected $currencySymbol = 'Rs.';

    protected $fillable = [
        'name', 'price', 'description', 'data',
    ];

    public function getCurrencySymbolAttribute($value)
    {

        return $this->currencySymbol;
    }

    public function discount()
    {
        return $this->morphOne('App\Discount', 'discountable');
    }

    public function expense()
    {
        return $this->morphOne('App\Expense', 'expendable');
    }

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

    public function users()
    {
        return $this->hasMany('App\User');
    }

    public function events($userId = null)
    {
        if (isset($userId)) {
            return $this->events()->where('user_id', '=', $userId)->get();
        }
        return $this->morphToMany('App\Event', 'eventable');
    }

    public function quotas()
    {

        return $this->hasMany('App\PackageQuota');
    }
}
