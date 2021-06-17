<?php

namespace App\Http\Controllers\Api;

use App\Apartment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    public function search(Request $request){
        $data = $request->all();
        $lat = $data['lat'];
        $long = $data['long'];
        $radius_km = 20; 

        $apartments = Apartment::selectRaw("* , ( 6371 * acos( cos( radians($lat) ) * cos( radians( `lat` ) ) * cos( radians( `long` ) - radians($long) ) + sin( radians($lat) ) * sin( radians( `lat` ) ) ) ) AS distance")
        ->where('visible', '=', true)
        ->having( 'distance', '<', $radius_km )
        ->orderBy('distance', 'asc' )
        ->get();
        foreach( $apartments as $apartment ) {
            $apartment->services;        
        }

        return response()->json($apartments);
    }
}
