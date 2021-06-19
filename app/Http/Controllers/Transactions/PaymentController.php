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

        $gateway = new Gateway([
            'environment' => env('BRAINTREE_ENV'),
            'merchantId' => env('BRAINTREE_MERCHANT_ID'),
            'publicKey' => env('BRAINTREE_PUBLIC_KEY'),
            'privateKey' => env('BRAINTREE_PRIVATE_KEY')
        ]);
        
        $result = $gateway->transaction()->sale ([
            'amount' =>  $request->session()->get('sponsor'),
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


        return response()->json($result);
    }

    public function form(Request $request, Apartment $apartment)
    {

        if($apartment->user_id != Auth::id()){
            abort('403');
        }

        $sponsor = Sponsor::where('name', 'Silver')->first();

        $request->session()->put('sponsor', $sponsor->price);

        $date = Carbon::now()->addHour($sponsor->hours)->isoFormat('DD-MM-YYYY, hh:mm');
        $user = User::where('id', Auth::id())->first();

        return view('ui.payments.payment', compact('sponsor','apartment','date'));


    }
}
