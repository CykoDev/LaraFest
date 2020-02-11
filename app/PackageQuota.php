<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackageQuota extends Model
{
    protected $fillable = [
        'package_id', 'event_id', 'event_type_id', 'quota_amount',
    ];

    public function package(){

        return $this->belongsTo('App\Package');
    }

    public function event(){

        return $this->belongsTo('App\Event');
    }

    public function eventType(){

        return $this->belongsTo('App\EventType', 'event_type_id');
    }
}
