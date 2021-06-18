@extends('../layouts.base-box')

@section('pageTitle')
    Risultati per - {{$city}}
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/search.css') }}">
    
    <link rel='stylesheet' type='text/css' href='https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.13.0/maps/maps.css'/>
@endsection

@section('mainTitle')
    Zona: {{$city}}
@endsection

@section('MainContent')
    <div id="app">
        <div class='control-panel'>
            <div class="text-right adv-search-btn-wrp">
                <button class="my-btn my-btn-primary filter "><i class="fas fa-filter"></i><span> Filtra</span></button>
            </div>
            <!-- ricerca avanzata -->
            <div class="advanced-search">
                <div class="search">
                    <label for="adv-search-city">Città</label>
                    <input type="text" name="city" v-model="city" id="adv-search-city" placeholder="Inserisci un nome di una città">
                    {{-- <button type="button" class="btn btn-success mt-2" @@click="apartmentsSearch">Cerca</button>
                    <button type="button" class="btn btn-success mt-2" @@click="nearBySearch">Nelle vicinanze</button> --}}
                </div>

                <h4 class="filter-title">Servizi</h4>
                <div class="filter">
                    @foreach ( $services as $service )
                        <div class="filter__services">
                            <input type="checkbox" name="{{$service->name}}" value="{{$service->name}}">
                            <label for="{{$service->name}}">{{$service->name}}</label>
                        </div>
                    @endforeach                    
                </div>
                <div class="text-right">
                    <button class="my-btn my-btn-primary search-btn"><i class="fas fa-chevron-right"></i></button>
                </div>
            </div>
            <!-- /ricerca avanzata -->
            <div id='apartments-list'>
                <a v-for="apartment in apartments" href="{{-- {{ route('apartments.show') }} + '/' + apartment.id --}}#" class="apartment-card"  :class="popupSelected == apartment.title? 'selected' : '' " v-if="{{-- target.every(v => arr.includes(v)) --}}">
                    <img class="card__image" src="{{ asset('storage/images/placeholder.png') }}" :alt="apartment.title">
                    <h4 class="card__title">@{{ apartment.title }}</h4>
                    <p class="card__rooms">Stanze: @{{ apartment.rooms }} | Bagni: @{{ apartment.bathrooms }} | Letti: @{{ apartment.beds }}</p>
                    <ul class="services-list">
                        <li v-for="service in apartment.services" class="card__service">
                            <i :class="service.icon_class"></i>
                        </li>
                    </ul>
                    <!--<p v-for="(service, i) in apartment.services" v-if="i == 0" class="card__service">@{{ service.name }}</p>
                    <p  v-else class="card__service"> - @{{ service.name }}</p> -->
                    <p class="card__description">@{{ apartment.description }}</p>
                </a>
            </div>    
        </div>

        <div id='map' class='map'></div>
    </div>
    
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js" integrity="sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
<script src='https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.13.0/maps/maps-web.min.js'></script>
<script src="{{ asset('js/search.js') }}" defer></script>
@endsection