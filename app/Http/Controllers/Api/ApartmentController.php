<?php

namespace App\Http\Controllers\Api;

use App\Apartment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Hamcrest\Type\IsNumeric;
use Illuminate\Support\Facades\Auth;

class ApartmentController extends Controller
{
    public function search(Request $request){
        $data = $request->all();
        $request->validate([
            'rooms' => 'numeric | max: 127',
            'bathrooms' => 'numeric | max: 127',
            'beds' => 'numeric | max: 127',
            'mq' => 'numeric | max: 3000',
            'radius' => 'numeric | max: 20038'
        ]);

        $lat = $data['lat'];
        $long = $data['long'];
        $radius_km = 20;
        $rooms = $data['rooms'];
        $bathrooms = $data['bathrooms'];
        $beds = $data['beds'];
        $mq = $data['mq'];
        $toDelete = [];

        if ( isset($data['services']) ) {
            $services = $data['services'];
        }

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
        if ( isset($data['services']) ) {
            foreach( $apartments as $index=>$apartment ) {
                $apArrServices = [];
                $apartment->route = route('ui.apartments.show', ['id' => $apartment->id]);
                $apartment->services;
                $apServices = $apartment->services()->get();
                foreach( $apServices as $apService ) {
                    $apArrServices[] = $apService->id;
                }
                foreach( $services as $service ) {
                    if ( !in_array( $service, $apArrServices ) ) {
                        $toDelete[] = $index;
                    }
                }
            }
            foreach ( $toDelete as $index ) {
                $apartments->forget($index);
            }
        } else {
            foreach( $apartments as $apartment ) {
                $apartment->route = route('ui.apartments.show', ['slug' => $apartment->slug]);
                $apartment->services;
            }
        }

        $sorted = $apartments->sortByDesc(function ($apartment) {
            $currentDate = Carbon::now();
            $sponsorColl = $apartment->sponsors()->where('expiration', '>=', $currentDate)->get();
            $sponsor = $sponsorColl->first();
            // L' appartamento non ha sponsor
            if ( $sponsor === null ) {
                return 0;
            }
            // L' appartamento ha sponsor
            $apartment->sponsors;
            if ( $sponsorColl->firstWhere('name', 'Silver') ) {
                return 1;
            } else if ( $sponsorColl->firstWhere('name', 'Gold') ) {
                return 2;
            } else if ( $sponsorColl->firstWhere('name', 'Platinum') ) {
                return 3;
            }
        });
        $apartments = $sorted->values()->all();

        return response()->json($apartments);
    }

    // Api per restituire lat e long alla ui e ur show

    public function apartment($id) {
        
        if ( is_numeric($id) ) {
            $apartment = Apartment::find($id);
        } else {
            $apartment = Apartment::where('slug', $id)->first();
        }

        return response()->json($apartment);
    }

    // Api per le visite tot.

    public function apartmentViews(Apartment $apartment) {
        
        $currentYear = Carbon::now()->format('Y');
        $monthlyViews = [];
        for ( $i = 1; $i <= 12; $i++ ) {
            if ( $i < 10 ) {
                $monthlyViews[$i - 1] = $apartment->views()->whereYear('created_at', $currentYear)->whereMonth('created_at', '0'.$i)->count();
            } else {
                $monthlyViews[$i - 1] = $apartment->views()->whereYear('created_at', $currentYear)->whereMonth('created_at', $i)->count();
            }
        }

        return response($monthlyViews);
    }

    // Api per i messaggi tot.

    public function apartmentMessages(Apartment $apartment) {
        
        $currentYear = Carbon::now()->format('Y');
        $monthlyMessages = [];
        for ( $i = 1; $i <= 12; $i++ ) {
            if ( $i < 10 ) {
                $monthlyMessages[$i - 1] = $apartment->messages()->whereYear('created_at', $currentYear)->whereMonth('created_at', '0'.$i)->count();
            } else {
                $monthlyMessages[$i - 1] = $apartment->messages()->whereYear('created_at', $currentYear)->whereMonth('created_at', $i)->count();
            }
        }

        return response($monthlyMessages);
    }

    // Api che restituisce tutti i messagi dell' appartamento

    public function messagesJson(Apartment $apartment) {

        $messages = $apartment->messages()->orderBy('created_at', 'desc')->get();
        foreach ( $messages as $message ) {
            $createdAt = Carbon::parse( $message['created_at'] )->format('d/m/Y');
            $message->date = $createdAt;
        }

        return response()->json($messages);
    }
}