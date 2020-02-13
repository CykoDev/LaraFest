<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = [
        'expendable_id', 'expendable_type', 'price', 'user_id',
    ];

    public function expendable() {
        return $this->morphTo();
    }
}
