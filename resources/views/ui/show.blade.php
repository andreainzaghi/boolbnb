
@extends('layouts.base-box')
@section('styles')

    {{-- style tom tom --}}
    <link rel='stylesheet' type='text/css' href='https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.13.0/maps/maps.css'/>
@endsection

@section('pageTitle')
  
@endsection

@section('MainContent')
<div class="box">

  @if (session('message'))
    <div class="alert alert-success" style="position: fixed; bottom: 30px; right: 6px; z-index: 2">
        {{ session('message') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
  @endif

  <div class="admin-appartamento d-flex"> 
        <!-- box-left -->
        <div class="box-left d-flex-colmn">

          <div class="title">
            <h3>{{ $apartment->title }}</h3>
            <p>{{ $apartment->address }}, {{ $apartment->city }}</p>
          </div>

          <div class="admin-img-box">
            <a href="#"><img class="immagine" src="{{asset('storage/'.$apartment['image'])}}" alt="Immagine appartamento"></a>
          </div>
         

          <div class="descrizione">
            <p class="recap d-flex">Stanze: {{ $apartment->rooms }} | Bagni: {{ $apartment->bathrooms }} | Letti: {{ $apartment->beds }} | Ospiti: 2 | Dimensioni: {{ $apartment->mq }} mq</p>
            <p class="sottotesto">{{ $apartment->description }}</p>
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
          </div>
        </div>




        <div class="box-right d-flex-colmn">
          <div class="guest-title-page">
            <div class="title-map">
              <h4>Posizione</h4>
              <span id="lat" class="d-none">{{ $apartment->lat }}</span><br>
              <span id="long" class="d-none">{{ $apartment->long }}</span>
            </div>
            <div id='map' class='mappa'>
            </div>
          </div>
          <div class="ui-msg">
               {{-- form invio messaggio lato guest  --}}
              <form action="{{route('ui.apartments.message', [$apartment->id])}}" method="GET" class="myForm" enctype="multipart/form-data">
                @method('GET')
                @csrf
                
                  {{-- campo email --}}
                <div class="email">
                  <label for="indirizzo email">Indirizzo email</label>
                  <input type="email" class="form-control form-control-sm" id="email" name="email" aria-describedby="emailHelp" placeholder="Inserisci la tua email" value="{{ old('email') }}" required>
                  <small id="emailHelp" class="form-text text-muted">Non condivideremo la tua email con nessuno</small>
                </div>
                  {{-- campo messaggio  --}}
                <div class="messaggio">
                  <label for="messaggio testo">Invia un messaggio al proprietario</label>
                  <textarea class="form-control form-control-sm" id="message" name="content" rows="8"
                  placeholder="Scrivi qui il messaggio" required></textarea>
                </div>
                {{-- <div>
                  <input type="text" value="{{$apartment->id}}">
                </div> --}}
                <div class="buttons-admin d-flex flex-wrap sp-btw"> 
                  <button type="submit" class="my-btn my-btn-primary">Invia messagio</button>  
                </div> 
              </form>
              {{-- form invio messaggio lato guest  --}}
          </div>
        </div>

               
  </div>
  {{-- bottoni lato admin --}}
  
  {{-- bottoni lato admin --}}    
  
</div>

@section('script')
  {{-- <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script> --}}
  <script src='https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.13.0/maps/maps-web.min.js'></script>
  <script src="{{ asset('js/show.js') }}" defer></script>
  @endsection

@endsection