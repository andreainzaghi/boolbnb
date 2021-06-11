<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    protected $guarded = ['services', 'sponsors'];

    // SERVICES
    public function services()
    {

        return $this->belongsToMany('App\Service');
    }

    // SERVICES
    public function sponsors()
    {

        return $this->belongsToMany('App\Sponsor');
    }

    // MESSAGES
    public function messages()
    {

        return $this->hasMany('App\Message');
    }

     
    // USER
    public function user()
    {

        return $this->belongsTo('App\User');
    }

    public function views()
    {
        return $this->hasMany('App\View');
    }
}
