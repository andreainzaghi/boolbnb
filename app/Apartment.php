<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Apartment extends Model
{

/*     public function setSlugAttribute($value) {

        if (static::whereSlug($slug = Str::slug($value))->exists()) {
    
            $slug = $this->incrementSlug($slug);
        }
    
        $this->attributes['slug'] = $slug;
    }

    public function incrementSlug($slug) {

        $original = $slug;
    
        $count = 2;
    
        while (static::whereSlug($slug)->exists()) {
    
            $slug = "{$original}-" . $count++;
        }
    
        return $slug;
    
    } */

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
