@extends('layouts.base-box')
@section('styles')
    
    <link rel='stylesheet' type='text/css' href='https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.13.0/maps/maps.css'/>
@endsection

@section('pageTitle')
    BoolBnb - Pagamento
@endsection

@section('MainContent')

<div class="container">
  <h1>Payment</h1>

     <div class="row">
       <div class="col-md-8 col-md-offset-2">
        <ul class="list-group">
          <h4 class="text-muted mt-4">Dettagli appartamento</h4>
          <li class="list-group-item bg-light text-muted">Nome appartamento: {{$apartment->title}}</li>
          <li class="list-group-item bg-light text-muted">Indirizzo: {{$apartment->address}} - {{$apartment->city}}</li>
          <li class="list-group-item bg-light text-muted">Sponsorizzazione: {{$sponsor->name}} - {{$sponsor->price}}&euro;</li>
          <li class="list-group-item bg-light text-muted">Data scadenza: {{$date}} </li>
          <li class="list-group-item bg-light text-muted">Latitudine: {{$apartment->lat}} </li>
          <li class="list-group-item bg-light text-muted">Longitudine: {{$apartment->long}} </li>
        </ul>
         <div id="dropin-container"></div>
         <button id="submit-button" class="btn btn-success">Procedi</button>
       </div>
     </div>
  </div>

  @section('script')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://js.braintreegateway.com/web/dropin/1.8.1/js/dropin.min.js"></script>

  <script>
    var button = document.querySelector('#submit-button');
    let apartment = "{{$apartment}}";

    braintree.dropin.create({
      authorization: "{{ Braintree\ClientToken::generate() }}",
      container: '#dropin-container'
    }, function (createErr, instance) {
      button.addEventListener('click', function () {
        instance.requestPaymentMethod(function (err, payload) {
          $.get('{{ route('payment.process', compact('apartment')) }}', {payload}, function (response) {
            if (response.success) {
              alert('Payment successfull!');
            } else {
              alert('Payment failed');
            }
          }, 'json');
        });
      });
    });
  </script>
  @endsection

@endsection