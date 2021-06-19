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
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading"><i class="far fa-check-circle"></i> Pagamento riuscito!</h4>
            <hr>
            <p class="mb-0">La tua sponsorizzazione finirà: {{$date}}</p>
          </div>
        
     </div>
  </div>

  <script>

            window.onload = function() {
                let apartment_id = "{{$apartment->id}}";
                setTimeout(function () {
                            window.location.replace("http://localhost:8000/admin/apartments/"+apartment_id);
                        }, 2000);
            };

  </script>

@endsection