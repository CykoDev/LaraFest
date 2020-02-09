<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use \Staudenmeir\EloquentJsonRelations\HasJsonRelationships;

class Photo extends Model
{
    use HasJsonRelationships;

    protected $public_path = '/img/';

    protected $fillable = [
        'path', 'type', 'uploaded_by_user_id',
    ];

    public function getPathAttribute($value){

        return $this->public_path . $value;
    }

    public function user(){
        return $this->belongsTo('App\User', 'uploaded_by_user_id');
    }

    public function getSize(){
        $bytes = Storage::disk('local_public')->size($this->path);
        $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB'];

        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }
}
