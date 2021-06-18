<?php

namespace App\Http\Controllers\Transactions;

use App\Apartment;
use App\Http\Controllers\Controller;
use App\Sponsor;
use App\User;
use Braintree\Transaction;
use Braintree;
use Braintree\Gateway;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{

    public function process(Request $request,Sponsor $sponsor, Apartment $apartment){

        // dd("ciao");
        // dd($data);
        // $user = $data['apartment'];
        // $sponsor = $data['sponsor'];
        $payload = $request->input('payload', false);
        $nonce = $payload['nonce'];
    
        $status = Braintree\Transaction::sale([
        'amount' => "2.99",
        'customer' => [
            'firstName' => 'Drew',
            'lastName' => 'Smith',
            'email' => 'drew@example.com'
          ],
        'paymentMethodNonce' => $nonce,
        'options' => [
            'submitForSettlement' => True
        ]
        ]);
    
        return response()->json($status);
            // return view('ui.payments.payment', compact('apartment','sponsor','date'));
    }

    public function form(Request $request, Apartment $apartment)
    {

        if($apartment->user_id != Auth::id()){
            abort('403');
        }

        

        $sponsor = Sponsor::where('name', 'Silver')->first();
        $data = ['apartment'=> $apartment,'sponsor'=> $sponsor];
        $date = Carbon::now()->addHour($sponsor->hours)->isoFormat('DD-MM-YYYY, hh:mm');
        $user = User::where('id', Auth::id())->first();

        dump(gettype($data));
        return view('ui.payments.payment', compact('apartment','sponsor','date'));


    }
}
