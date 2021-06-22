@extends('layouts.base-box')
@section('styles')

    {{-- style tom tom --}}
    <link rel='stylesheet' type='text/css' href='https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.13.0/maps/maps.css'/>

@endsection

@section('pageTitle')
  
@endsection

@section('MainContent')
<div class="box w-100">

  @if ( isset($sponsor_expiration) )
    <div class="admin-sponsor-box d-flex sp-btw flex-wrap">

        {{-- checkboxes  --}}
        <form action="{{route('payment.form', ['apartment' => $apartment->id])}}" method="GET" class="myForm" enctype="multipart/form-data">
          @method('GET')
          @csrf
        
            @foreach ($sponsors as $sponsor)
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="{{ $sponsor->name }}" name="sponsor" class="custom-control-input" value="{{ $sponsor }}">
                <label class="custom-control-label color" for="{{ $sponsor->name }}"> {{ $sponsor->name }} | {{ $sponsor->price }} € per {{ $sponsor->hours }} ore</label>
              </div>
            @endforeach

          <button type="submit" class="my-btn my-btn-primary submit">Sponsorizza</button>
        </form>
        
      </div> 
    @endif
   
  <div class="admin-appartamento d-flex"> 

        <!-- box-left -->

        <div class="box-left d-flex-colmn">

          <div class="title">
            <h3>{{ $apartment->title }}</h3>
            <p id="address">{{ $apartment->address }}, {{ $apartment->city }}</p>
          </div>

          <div class="admin-img-box">
            <a href="#"><img class="immagine" src="{{asset('storage/'.$apartment['image'])}}" alt="Immagine appartamento"></a>
          </div>

          <div class="descrizione">
            <p class="recap d-flex">Stanze: {{ $apartment->rooms }} | Bagni: {{ $apartment->bathrooms }} | Letti: {{ $apartment->beds }} | Ospiti: 2 | Dimensioni: {{ $apartment->mq }} mq</p>
            <p class="sottotesto">{{ $apartment->description }}</p>
            {{-- serivizi --}}
            <div class="select-servizi d-flex-colmn flex-wrap">
              <h4>Servizi</h4> 
              <div class="list_services">
              @foreach( $apartment->services as $service )
                <div class="services_wrap">
                  <p>{{$service->name}}</p>
                  <i class="{{ $service->icon_class }}"></i>
                </div>
              @endforeach
              </div>
            </div>  
            {{-- serivizi --}}        
          </div>
        </div>

        <!-- box-right -->
        <div class="box-right d-flex-colmn">
          <div class="admin-title-page">
            <div class="title-map">
              <h4>Posizione</h4>
            </div>
            <div id='map' class='mappa'>
            </div>
          </div>
          <div class="alert-admin">
            @if ( !isset($sponsor_expiration) )
              <p><i class="fas fa-exclamation-circle"></i> Questo appartamento è sponsorizzato. <br>La promozione scadrà in data: <span>{{ $apartment->sponsor_expiration }}</span></p>
            @endif
            </div>
        </div>

  </div>
  {{-- bottoni lato admin --}}
  <div class="admin-button d-flex flex-wrap sp-btw mt-5">
    <a href="{{ route( 'admin.apartments.edit', ['apartment' => $apartment->id ] ) }}" class="my-btn my-btn-secondary"><span class=" d-md-inline-block">Modifica</span></a> 
    <a href="{{ route( 'admin.apartments.messages', ['apartment' => $apartment->id ] ) }}" class="my-btn my-btn-secondary"><span class=" d-md-inline-block">Visualizza messaggi</span></a>
    <form class="mt-0" action="{{ route( 'admin.apartments.destroy', ['apartment' => $apartment->id ] ) }}" method="POST">                             
      @method('DELETE')                             
      @csrf                             
      <button type="submit" class="my-btn my-btn-primary"><span class=" d-md-inline-block">Elimina struttura</span></a>  
      {{-- <button type="submit" class="btn btn-danger actions"><i class="fas fa-trash-alt"></i></button> --}}                         
      </form>
  </div> 
  {{-- bottoni lato admin --}}   

  
  {{-- chart js  --}}
  <div class="chart-container">
    <h4>Statistiche dell'appartamento</h4>
    <canvas id="myChart"></canvas>
  </div>

  
</div>
{{-- -box conentitore  --}}

 



  @section('script')
  
    {{-- tom tom script  --}}
    <script src='https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.13.0/maps/maps-web.min.js'></script>
    <script src="{{ asset('js/show.js') }}" defer></script>

    {{-- chart js script --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.3.2/dist/chart.min.js"></script>
 
  @endsection

@endsection