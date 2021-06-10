<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $guarded = [];


    // APARTMENT
    public function apartment()
    {
        return $this->belongsTo('App\Appartment');
    }
}
