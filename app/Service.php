<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $guarded = [];

    // APARTMENTS
    public function apartments()
    {
        return $this->belongsToMany('App\Apartment');
    }
}
