<?php

namespace App\Http\Controllers\Transactions;

use App\Apartment;
use App\Http\Controllers\Controller;
use App\Sponsor;
use App\User;
use Braintree\Gateway;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{

    public function process(Request $request){

        $user = User::where('id',Auth::id())->first();

        $request['token'] =  'fake-valid-nonce';
        $sponsor = Sponsor::where('id',$request->session()->get('sponsor_id'))->first();
        $apartment = Apartment::where('id',$request->session()->get('apartment_id'))->first();


        $date = Carbon::now()->addHour($sponsor->hours)->isoFormat('DD-MM-YYYY, hh:mm');

        $request->session()->get('date_expiration', $date);

        $gateway = new Gateway([
            'environment' => env('BRAINTREE_ENV'),
            'merchantId' => env('BRAINTREE_MERCHANT_ID'),
            'publicKey' => env('BRAINTREE_PUBLIC_KEY'),
            'privateKey' => env('BRAINTREE_PRIVATE_KEY')
        ]);
        
        $result = $gateway->transaction()->sale ([
            'amount' =>  $sponsor->price,
            'paymentMethodNonce' => $request->token,
            'customer' => [
                'firstName' => $user->name,
                'lastName' => $user->last_name,
                'company' => 'BoolBnb',
                'website' => 'http://www.boolbnb.com',
                'email' => $user->email
            ],
            'options' => [
                'submitForSettlement' => True]
            ]);

        $request->session()->put('settled', true);

        return response()->json($result);
    }


    public function form(Request $request, Apartment $apartment)
    {

        // Controllo se è l'utente dell'appartamento
        if($apartment->user_id != Auth::id()){
            abort('403');
        }

        // Controllo se è visibile
        if($apartment->visible == 1){
            if($apartment->sponsors()->orderBy('expiration', 'desc')->first()){
                if( $apartment->sponsors()->orderBy('expiration', 'desc')->first()->expiration > Carbon::now()){
                    abort('403', "Non puoi fare una nuova sponsorizzazione finchè non è finita quella in corso!");
                }
            }
        }
        else{
            abort('403', "L'appartamento deve essere visibile per essere sponsorizzato");
            
        }
    

        $data = $request->all();
        $sponsor = json_decode($data['sponsor']);

        // $sponsor = Sponsor::find($data['sponsor'])->get();

        $request->session()->put('sponsor_id', $sponsor->id);
        $request->session()->put('apartment_id', $apartment->id);
        

        $date = Carbon::now(+2)->addHour($sponsor->hours)->format('d-m-Y, H:i:s');
        $user = User::where('id', Auth::id())->first();


        $request->session()->put('date_expiration', $date);


        return view('admin.apartments.payments.payment', compact('sponsor','apartment','date'));
    }


    public function success(Request $request)
    {
        if(!$request->session()->get('settled')){
            abort('403', 'Non hai effettuato il pagamento!!!');
        }

        $sponsor = Sponsor::where('id',$request->session()->get('sponsor_id'))->first();
        $apartment = Apartment::where('id',$request->session()->get('apartment_id'))->first();

        if($apartment->user_id != Auth::id()){
            abort('403');
        }

        $dateParse = Carbon::parse($request->session()->get('date_expiration'));
        $date = $dateParse->format('Y-m-d H:i:s');
    
        $apartment->sponsors()->attach($sponsor,['expiration' => $date, 'settled' =>1]);

        $request->session()->forget('settled');

        return view('admin.apartments.payments.success', compact('sponsor','apartment','date'));

    }


    public function error(Request $request)
    {

        $apartment = Apartment::where('id',$request->session()->get('apartment_id'))->first();

        if($apartment->user_id != Auth::id()){
            abort('403');
        }

        $request->session()->forget('settled');


        return view('admin.apartments.payments.error', compact('apartment'));

    }
}
