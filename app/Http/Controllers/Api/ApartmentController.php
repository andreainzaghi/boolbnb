<?php

namespace App\Http\Controllers\Api;

use App\Apartment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    public function search(Request $request){
        $data = $request->all();
        $request->validate([
            'rooms' => 'numeric | max: 127',
            'bathrooms' => 'numeric | max: 127',
            'beds' => 'numeric | max: 127',
            'mq' => 'numeric | max: 3000',
        ]);

        $lat = $data['lat'];
        $long = $data['long'];
        $radius_km = 20;
        $rooms = $data['rooms'];
        $bathrooms = $data['bathrooms'];
        $beds = $data['beds'];
        $mq = $data['mq'];

        if ( isset($data['radius']) ) {
            $radius_km = $data['radius'];
        }
        
        $apartments = Apartment::selectRaw("* , ( 6371 * acos( cos( radians($lat) ) * cos( radians( `lat` ) ) * cos( radians( `long` ) - radians($long) ) + sin( radians($lat) ) * sin( radians( `lat` ) ) ) ) AS distance")
        ->where('rooms', '>=', $rooms)
        ->where('bathrooms', '>=', $bathrooms)
        ->where('beds', '>=', $beds)
        ->where('mq', '>=', $mq)
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
