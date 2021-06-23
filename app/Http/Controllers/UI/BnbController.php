<?php

namespace App\Http\Controllers\UI;

use App\Http\Controllers\Controller;
use App\Sponsor;
use Illuminate\Support\Facades\Auth;
use App\Service;
use App\Apartment;
use App\Message;
use App\View;
use App\User;
use App\Mail\SendNewMail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Symfony\Component\VarDumper\VarDumper;

class BnbController extends Controller
{
    
    protected $validation = [];

    public function __construct() {
        $this->validation = [
            'email' => 'required | string | email | max:100',
            'content' => 'required | string',
        ];
    }


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
    
    public function show($slug){

        $apartment = Apartment::where('slug', $slug)->first();

        if($apartment->user_id == Auth::id()){
            return redirect()
            ->route('admin.apartments.show', $apartment);
        }

        $clientIP = request()->ip();
   

        $newView['apartment_id'] = $apartment->id;
        $newView['ip'] = $clientIP;

        $view = $apartment->views()->where('ip', $clientIP)->first();

        //Controllo se l'ip è già presente, in caso contrario lo inserisco
        if(!$view){
            $newView = View::create($newView);
        }

        return view('ui.show', compact('apartment'));
    }



    public function sendMessage(Request $request, $slug){


        $request->validate( $this->validation );
        $data = $request->all();

        //$apartment = Apartment::find(intval($id));
        $apartment = Apartment::where('slug', $slug)->first();
        $data['apartment_id'] = intval($apartment->id);

        Message::create( $data );
        
        $message = $data['content'];
        $user = User::where('id', $apartment->user_id)->first();

        // Invio della maiil
        Mail::to($user->email)->send(new SendNewMail($apartment, $message, $data['email']));
        return redirect()
            ->route('ui.apartments.show', $slug)
            ->with('message', 'Il messaggio è stato inviato!');
    }
}
