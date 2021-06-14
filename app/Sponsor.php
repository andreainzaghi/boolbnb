<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    protected $guarded = [];

    // APARTMENT
    public function apartments()
    {
        return $this->belongsToMany('App\Apartment');
    }
}
