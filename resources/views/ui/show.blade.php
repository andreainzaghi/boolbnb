
@extends('layouts.base-box')
@section('styles')
   
    
    <link rel='stylesheet' type='text/css' href='https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.13.0/maps/maps.css'/>
@endsection

@section('pageTitle')
    BoolBnb - Dashboard
@endsection

@section('MainContent')

<div class="box">
  <div class="interno-profilo">
        <!-- title page -->
        <div class="title-page">
          <!-- v-for per ciclare il titolo-->
          <div class="title">
            <h3>{{$apartment['title']}}</h3>
            <p>{{$apartment['address']. ' - ' . $apartment['city']}}</p>
          </div>
          <div class="title-map">
            <h4>Posizione</h4>
          </div>
        </div>
        <!-- immagini -->
        <div class="immagini">
          <div class="immagineappartamento">


            <img src="{{asset('storage/'.$apartment['image'])}}" alt="immagine appartamento">
            {{-- <img class="imgaff" src="img/app.jpg" alt="">
            
            <img class="imgaff" src="img/art.jpg" alt="">
            <img class="imgaff" src="img/ds.jpg" alt=""> --}}
            
          </div>
          <div id='map' class='mappe'></div>
        </div>
        <!-- cose della stanza -->
        <div class="box-appartamento">
          <div class="descrizione">
            <p class="recap">Stanze: {{$apartment['rooms']}} | Bagni: {{$apartment['bathrooms']}} | Letti: {{$apartment['beds']}} | Ospiti: 2 | Dimensioni: {{$apartment['mq'].'mq'}} </p>
            <p class="sottotesto">{{$apartment['description']}}</p>
            <div class="select-servizi">
              <h4>Servizi</h4> 
              {{-- checkboxes lato admin --}}
              {{-- <div class="check-square">
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
              </div> --}}
              {{-- checkboxes lato admin --}}

            </div>          
          </div>
          <div class="box-right">

            {{-- messaggio alert lato admin --}}
            {{-- <div class="alert">
              <p><i class="fas fa-exclamation-circle"></i> Questo appartamento è sponsorizzato. <br>La promozione scadrà in data: 21-06-2022</p>
            </div> --}}
            {{-- messaggio alert lato admin --}}

            {{-- form invio messaggio lato guest  --}}
            <div class="send-msg">
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
            </div>
            {{-- form invio messaggio lato guest  --}}

          </div>
        </div>
        
        {{-- bottoni lato guest  --}}
        <div class="buttons">  
          <a href="#" class="my-btn my-btn-primary"><span class="d-none d-md-inline-block">Invia</span></a>  
        </div>
        {{-- bottoni lato guest  --}}

        {{-- bottoni lato admin --}}
        {{-- <div class="buttons">
          <a href="#" class="my-btn my-btn-secondary"><span class="d-none d-md-inline-block">Modifica</span></a> 
          <a href="#" class="my-btn my-btn-secondary"><span class="d-none d-md-inline-block">Sponsorizza</span></a>  
          <a href="#" class="my-btn my-btn-secondary"><span class="d-none d-md-inline-block">Visualizza messaggi</span></a>   
          <a href="#" class="my-btn my-btn-primary"><span class="d-none d-md-inline-block">Elimina</span></a>  
        </div>  --}}
        {{-- bottoni lato admin --}}      
  </div>
</div>
</div>

  <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
  <script src='https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.13.0/maps/maps-web.min.js'></script>
  @section('script')
  <script src="{{ asset('js/show.js') }}" defer></script>
  @endsection

@endsection