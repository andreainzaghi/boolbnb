<?php

namespace App\Http\Controllers\UI;

use App\Http\Controllers\Controller;
use App\Sponsor;
use App\Service;
use App\Apartment;
use App\View;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\VarDumper\VarDumper;

class BnbController extends Controller
{
    public function index() {
        $count = 0;
        $sponsors = Sponsor::orderBy('id', 'desc')->get();
        $query = [];
        $sponsored = [];

        foreach ( $sponsors as $sponsor ) {
            $currentDate = Carbon::now();
            $query[] = $sponsor->apartments()->where('expiration', '>', $currentDate)->get();
        }
        foreach ( $query as $array ) {
            foreach ( $array as $apartment ) {
                $sponsored[] = $apartment;
          } 
        }

        if ($sponsored == []) {
            return view('ui.welcome');
        } 

        return view('ui.welcome', compact('sponsored'));
    }

    public function search(Request $request) {
        $data = $request->all();

        $city = $data['city'];
        $apartments = Apartment::where('city', 'LIKE', '%'.$city.'%')->get();
        $services = Service::all();
        
        return view('ui.search', compact('apartments', 'city', 'services'));

    }
    
    public function show($id){

        $clientIP = request()->ip();
   
        $apartment = Apartment::where('id', $id)->first();

        $newView['apartment_id'] = $id;
        $newView['ip'] = $clientIP;
        $newView = View::create($newView);

        return view('ui.show', compact('apartment'));
    }



    public function sendMessage(Request $request, Apartment $apartment){


        // MANCA LA VALIDAZIONE
        $data = $request->all();
        $data['apartment_id'] = $apartment->id; 

        $newaMessage = Message::create( $data );
    }
}
