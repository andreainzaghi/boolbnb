<?php

namespace App\Http\Controllers\Transactions;

use App\Apartment;
use App\Http\Controllers\Controller;
use App\Sponsor;
use Braintree\Gateway;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PaymentController extends Controller
{

    public function form(Apartment $apartment){

        $sponsor = Sponsor::where('name', 'Silver')->first();
        $date = Carbon::now()->addHour($sponsor->hours)->isoFormat('DD-MM-YYYY, hh:mm');

        return view('ui.payments.payment', compact('apartment','sponsor','date'));
        //return redirect( 'apartments/{apartment}/payment/result')->with("");
    }

    public function process(Request $request, Gateway $gateway)
    {

        dd("processo pagamento");
      //  dd($gateway->clientToken()->generate());
    // $payload = $request->input('payload', false);
    // $nonce = $payload['nonce'];

    // $status = Braintree\Transaction::sale([
	// 'amount' => '10.00',
	// 'paymentMethodNonce' => $nonce,
	// 'options' => [
	//     'submitForSettlement' => True
	// ]
    // ]);

    //         if ($status->success) {
    //     print_r("success!: " . $status->transaction->id);
    // } else if ($status->transaction) {
    //     print_r("Error processing transaction:");
    //     print_r("\n  code: " . $status->transaction->processorResponseCode);
    //     print_r("\n  text: " . $status->transaction->processorResponseText);
    // } else {
    //     foreach($status->errors->deepAll() AS $error) {
    //         print_r($error->code . ": " . $error->message . "\n");
    //     }
    // }

    //     return response()->json($status);
  
    // }

    }
}
