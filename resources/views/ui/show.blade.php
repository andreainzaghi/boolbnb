@extends('layouts.base-box')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/show.css') }}">
    
    <link rel='stylesheet' type='text/css' href='https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.13.0/maps/maps.css'/>
@endsection
@section('pageTitle')
    BoolBnb - Dashboard
@endsection

@section('MainContent')
  

      <div class="interno-profilo">
        <!-- title page -->
        <div class="title-page">
          <!-- v-for per ciclare il titolo-->
          <div class="title">
            <h3>Casa Paradiso</h3>
            <p>via Padova Rossi ,Milano,73102</p>
          </div>
          <div class="alert">
            <p>questo appartamento e' sponsorizzato
              la promozione scadra il giorno 21/12/2021</p>
            </div>
          </div>
          <!-- immagini -->
          <div class="immagini">
            <div 
             :class="immagineappartamento">
            {{-- <img class="imgaff" src="img/app.jpg" alt="">
            <img class="imgaff" src="img/3e.jpg" alt="">
            <img class="imgaff" src="img/art.jpg" alt="">
            <img class="imgaff" src="img/ds.jpg" alt=""> --}}
            
          </div>
          <div id='map' :class='map'></div>
        </div>
        <!-- cose della stanza -->
        <div class="peculiarita-stanza">
          <div class="sottot">
            <p>stanze:5|bagni:3|letti:3|ospiti:2|dimensioni:90mq</p>
            <p class="sottotesto">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            
          </div>
          
          
        </div>
        <div class="check-square">
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
        <div class="buttons">
          <div class="button-1">
            <button type="button" name="button">Modifica</button>
          </div>
          <div class="button-1">
            <button type="button" name="button">Sponsorizza</button>
          </div>
          <div class="button-1">
            <button type="button" name="button">Statistiche</button>
          </div>
          <div class="button-1">
            <button type="button" name="button">Visualizza Messaggi</button>
          </div>
          <div class="button-1">
            <button type="button" name="button">Elimina</button>
          </div>
      
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
  <script src='https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.13.0/maps/maps-web.min.js'></script>
  @section('script')
  <script src="{{ asset('js/show.js') }}" defer></script>
  @endsection

@endsection