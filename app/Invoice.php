<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Invoice extends Model
{
    protected $fillable = [
        'user_id', 'total', 'path',
    ];

    protected $public_path = '/img/invoices/';

    public function getPathAttribute($value){

        return $this->public_path . $value;
    }

    public function user(){
        return $this->belongsTo('App\User');
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
