
@extends('layouts.base-box')
@section('styles')

    {{-- style tom tom --}}
    <link rel='stylesheet' type='text/css' href='https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.13.0/maps/maps.css'/>
@endsection

@section('pageTitle')
  
@endsection

@section('MainContent')

<div class="box">

  <div class="admin-appartamento d-flex"> 
        <!-- box-left -->
        <div class="box-left d-flex-colmn">

          <div class="title">
            <h3>{{$apartment['title']}}</h3>
            <p>{{$apartment['address']. ' - ' . $apartment['city']}}</p>
          </div>


            <img src="{{asset('storage/'.$apartment['image'])}}" alt="immagine appartamento">
            {{-- <img class="imgaff" src="img/app.jpg" alt="">
            
            <img class="imgaff" src="img/art.jpg" alt="">
            <img class="imgaff" src="img/ds.jpg" alt=""> --}}
            
          </div>
         

          <div class="descrizione">
            <p class="recap">Stanze: {{$apartment['rooms']}} | Bagni: {{$apartment['bathrooms']}} | Letti: {{$apartment['beds']}} | Ospiti: 2 | Dimensioni: {{$apartment['mq'].'mq'}} </p>
            <p class="sottotesto">{{$apartment['description']}}</p>
            <div class="select-servizi">
              <h4>Servizi</h4> 
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
          <div class="ui-msg">
               {{-- form invio messaggio lato guest  --}}
            
                <div class="email">
                  {{-- campo email --}}
                  <label for="indirizzo email">Indirizzo email</label>
                  <input type="email" class="form-control form-control-sm" id="email" aria-describedby="emailHelp" placeholder="Inserisci la tua email" value="{{ old('email') }}">
                  <small id="emailHelp" class="form-text text-muted">Non condivideremo la tua email con nessuno</small>
                </div>
                  {{-- campo messaggio  --}}
                <div class="messaggio">
                  <label for="messaggio testo">Invia un messaggio al proprietario</label>
                  <textarea class="form-control form-control-sm" id="message" rows="8"
                  placeholder="Scrivi qui il messaggio"></textarea>
                </div>
              
              {{-- form invio messaggio lato guest  --}}
          </div>
        </div>

               
  </div>
  {{-- bottoni lato admin --}}
  <div class="buttons-admin d-flex flex-wrap sp-btw"> 
    <a href="#" class="my-btn my-btn-primary"><span class=" d-md-inline-block">Invia messagio</span></a>  
  </div> 
  {{-- bottoni lato admin --}}    
  
</div>

  <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
  <script src='https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.13.0/maps/maps-web.min.js'></script>
  @section('script')
  <script src="{{ asset('js/show.js') }}" defer></script>
  @endsection

@endsection