<?php

namespace App\Http\Controllers\Api;

use App\Apartment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    public function search(Request $request){
        $data = $request->all();

        $city = $data['city'];
        $apartments = Apartment::where('city', 'LIKE', '%'.$city.'%')->get();
        foreach( $apartments as $apartment ) {
            $apartment->services;        
        }

        return response()->json($apartments);
    }
}
