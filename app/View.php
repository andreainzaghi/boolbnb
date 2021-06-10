<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    protected $guarded = [];

    // APARTMENT
    public function apartment()
    {
        return $this->belongsTo('App\Apartment');
    }
}
