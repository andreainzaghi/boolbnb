
@extends('layouts.base-box')
@section('styles')

    {{-- style tom tom --}}
    <link rel='stylesheet' type='text/css' href='https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.13.0/maps/maps.css'/>
@endsection

@section('pageTitle')
  
@endsection

@section('MainContent')
<div class="box">
  <div class="admin-sponsor-box d-flex sp-btw flex-wrap ">
    {{-- checkboxes  --}}
    <div class="custom-control custom-radio custom-control-inline">
      <input type="radio" id="customRadioInline1" name="customRadioInline1" class="custom-control-input">
      <label class="custom-control-label" for="customRadioInline1">Silver | 2,99 € per 24 ore</label>
    </div>
    <div class="custom-control custom-radio custom-control-inline">
        <input type="radio" id="customRadioInline2" name="customRadioInline1" class="custom-control-input">
        <label class="custom-control-label" for="customRadioInline2">Gold | 5,99 € per 72 ore</label>
    </div>
    <div class="custom-control custom-radio custom-control-inline">
      <input type="radio" id="customRadioInline3" name="customRadioInline1" class="custom-control-input">
      <label class="custom-control-label" for="customRadioInline3">Platinum | 9,99 € per 144 ore</label>
    </div>
    {{-- checkboxes  --}}
    {{-- bottone sponsorizza  --}}
    <div class="buttons-admin">
      <a href="#" class="my-btn my-btn-primary"><span class=" d-md-inline-block">Sponsorizza</span></a> 
    </div>
    {{-- bottone sponsorizza  --}}
      
  </div> 
  
  
  <div class="admin-appartamento d-flex"> 

        <!-- box-left -->

        <div class="box-left d-flex-colmn">

          <div class="title">
            <h3>Casa Paradiso</h3>
            <p>via Padova Rossi, Milano 73102</p>
          </div>

          <div class="admin-img-box">
            <a href="#"><img class="immagine" src="{{asset('storage/'.$apartment['image'])}}" alt="Immagine appartamento"></a>
          </div>

          <div class="descrizione">
            <p class="recap d-flex">Stanze: 5 | Bagni: 3| Letti: 3 | Ospiti: 2 | Dimensioni: 90mq </p>
            <p class="sottotesto">Lorem ipsum dolor sit amet, consectetur adipisicing elit, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit. Lorem ipsum dolor sit amet, consectetur adipisicing elit, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit.</p>
            <div class="select-servizi d-flex-colmn flex-wrap">
              <h4>Servizi</h4> 
              {{-- checkboxes lato admin --}}
              <div class="check-squares d-flex flex-wrap sp-btw">
                <div class="square-1">
                  Cucina
                  
                  <input type="checkbox" name="" value="">
                  
                </div>
                <div class="square-2">
                  Wifi
                  
                  <input type="checkbox" name="" value="">
                  
                </div>
                <div class="square-3">
                  Tv
                  
                  <input type="checkbox" name="" value="">
                  
                </div>
                <div class="square-4">
                  Lavatrice
                  
                  <input type="checkbox" name="" value="">
                  
                </div>
                <div class="square-5">
                  Biancheria
                  
                  <input type="checkbox" name="" value="">
                  
                </div>
                <div class="square-6">
                  Cucina
                  
                  <input type="checkbox" name="" value="">
                  
                </div>
                <div class="square-7">
                  Superfice
                  
                  <input type="checkbox" name="" value="">
                  
                </div>
              </div>
              <div class="check-squares d-flex flex-wrap sp-btw">
                <div class="square-1">
                  Cucina
                  
                  <input type="checkbox" name="" value="">
                  
                </div>
                <div class="square-2">
                  Wifi
                  
                  <input type="checkbox" name="" value="">
                  
                </div>
                <div class="square-3">
                  Tv
                  
                  <input type="checkbox" name="" value="">
                  
                </div>
                <div class="square-4">
                  Lavatrice
                  
                  <input type="checkbox" name="" value="">
                  
                </div>
                <div class="square-5">
                  Biancheria
                  
                  <input type="checkbox" name="" value="">
                  
                </div>
                <div class="square-6">
                  Cucina
                  
                  <input type="checkbox" name="" value="">
                  
                </div>
                <div class="square-7">
                  Superfice
                  
                  <input type="checkbox" name="" value="">
                  
                </div>
              </div>
              {{-- checkboxes lato admin --}}

            </div>          
          </div>
        </div>




        <div class="box-right d-flex-colmn">
          <div class="admin-title-page">
            <div class="title-map">
              <h4>Posizione</h4>
            </div>
            <div id='map' class='mappa'></div>
          </div>
          <div class="alert-admin">
            <p><i class="fas fa-exclamation-circle"></i> Questo appartamento è sponsorizzato. <br>La promozione scadrà in data: <span>21-06-2022</span></p>
          </div>
        </div>

        <!-- rifaccio -->           
  </div>
  {{-- bottoni lato admin --}}
  <div class="buttons-admin d-flex flex-wrap sp-btw">
    <a href="#" class="my-btn my-btn-secondary"><span class=" d-md-inline-block">Modifica</span></a> 
    <a href="#" class="my-btn my-btn-secondary"><span class=" d-md-inline-block">Visualizza messaggi</span></a>   
    <a href="#" class="my-btn my-btn-primary"><span class=" d-md-inline-block">Elimina struttura</span></a>  
  </div> 
  {{-- bottoni lato admin --}}    
  
</div>

  <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
  <script src='https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.13.0/maps/maps-web.min.js'></script>
  @section('script')
  <script src="{{ asset('js/show.js') }}" defer></script>
  @endsection

@endsection