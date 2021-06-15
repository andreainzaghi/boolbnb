<?php

namespace App\Http\Controllers\UI;

use App\Http\Controllers\Controller;
use App\Sponsor;
use App\Apartment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BnbController extends Controller
{
    public function index() {
        $count = 0;
        $sponsors = Sponsor::orderBy('id', 'desc')->get();
        foreach ( $sponsors as $sponsor ) {
            $currentDate = Carbon::now();
            $query[] = $sponsor->apartments()->where('expiration', '>', $currentDate)->get();
        }
        foreach ( $query as $array ) {
            foreach ( $array as $apartment ) {
                $sponsored[] = $apartment;
            }
        }
        return view('ui.welcome', /*compact('sponsored')*/);
    }

    public function search(Request $request) {
        $data = $request->all();

        $city = $data['city'];
        $apartments = Apartment::where('city', 'LIKE', '%'.$city.'%')->get();

        return view('ui.search', compact('apartments', 'city'));

    }
}
