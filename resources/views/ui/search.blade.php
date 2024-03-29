@extends('../layouts.base-box')

@section('pageTitle')
    BoolBnb - Ricerca Appartamenti
@endsection

@section('styles')
    <link rel='stylesheet' type='text/css' href='https://api.tomtom.com/maps-sdk-for-web/cdn/plugins/SearchBox/3.1.11/SearchBox.css'>
    <link rel='stylesheet' type='text/css' href='https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.13.0/maps/maps.css'/>
    <link rel="stylesheet" href="{{ asset('css/search.css') }}">


    {{-- <script src='https://npmcdn.com/mapbox-gl-circle/dist/mapbox-gl-circle.min.js'></script> --}}
@endsection

@section('mainTitle')
<i class="fas fa-map-marker-alt"></i> <span id="city_title"></span>
@endsection

@section('MainContent')
    <div id="app">
        <div class='control-panel' :class="{ 'h_50' : showMap }">
            <div class="text-right adv-search-btn-wrp">
                <button v-on:click=" showMap = !showMap " class="my-btn my-btn-primary show-map "><i class="far fa-map"></i></button>
                <button v-on:click=" showAdvSearch = !showAdvSearch " v-bind:class="{ 'active' : showAdvSearch }" class="my-btn my-btn-primary filter "><i class="fas fa-filter"></i><span> Filtra</span></button>
            </div>
            <!-- ricerca avanzata -->
            <div v-bind:class="{ 'active' : showAdvSearch }" class="advanced-search">
                <div class="search">
                    <label for="adv-search-city">Città</label>
                    <input class="form-control" v-on:keyup.letters="autocomplete()" v-on:keydown.enter="select()" v-on:keydown.up="selectUp($event)" v-on:keydown.down="selectDown($event)" v-on:focus="cityFocus = true" v-on:blur="cityFocus = false"  autocomplete="off" class="search" type="text" name="searchCity" v-model="city" id="adv-search-city">
                    <ul class="results-box" :class=" results.length === 0 || cityFocus === false && mouseOverRes === false ? 'd-none' : 'd-block'" v-on:mouseover="mouseOverRes = true" v-on:mouseleave="mouseOverRes = false">
                        <li v-on:click="addToCity($event); results = []; mouseOverRes = false;" class="result" :class=" resultSelected == i? 'selected' : '' " v-for="(result, i) in results">@{{ result.address.freeformAddress+', '+result.address.countrySubdivision }}</li>
                    </ul>
                </div>
                <div class="filter__services-num mt-1">
                    <label>raggio (km)</label>
                    <input class="form-control" type="number" v-model="radius" min="1" max="20038" value="">
                    <button class="input-number-add"></button>
                    <button class="input-number-sub"></button>
                </div>
                <h4 class="filter-title mt-3">Caratteristiche</h4>
                <div class="filter-num">
                    <div class="filter__services-num">
                        <label>n° stanze</label>
                        <input class="form-control" type="number" v-model="rooms" min="1" max="16" value="">
                        <button class="input-number-add"></button>
                        <button class="input-number-sub"></button>
                    </div>
                    <div class="filter__services-num">
                        <label>n° bagni</label>
                        <input class="form-control" type="number" v-model="bathrooms" min="1" max="16" value="">
                        <button class="input-number-add"></button>
                        <button class="input-number-sub"></button>
                    </div>
                    <div class="filter__services-num">
                        <label>n° letti</label>
                        <input class="form-control" type="number" v-model="beds" min="1" max="16" value="">
                        <button class="input-number-add"></button>
                        <button class="input-number-sub"></button>
                    </div>
                    <div class="filter__services-num">
                        <label>superfice (mq)</label>
                        <input class="form-control" type="text" v-model="mq" value="">
                    </div>
                </div>
                <h4 class="filter-title mt-3">Servizi</h4>
                <div class="filter__services">
                    @foreach ( $services as $service )
                        <div class="form-check services">
                            <label class="form-check-label" for="{{ $service->name }}">{{ $service->name }}
                                <input class="form-check-input" type="checkbox" v-model="services" value="{{ $service->id }}" id="{{ $service->name }}" name="{{$service->name}}">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        {{-- <div class="filter__services">
                            <input id="{{$service->name}}" type="checkbox" name="{{$service->name}}" v-model="services" value="{{$service->id}}">
                            <label for="{{$service->name}}">{{$service->name}}</label>
                        </div> --}}
                    @endforeach                    
                </div>
                <div class="text-right">
                    <button v-on:click="getPosition(); showAdvSearch = !showAdvSearch" class="my-btn my-btn-primary search-btn"><i class="fas fa-chevron-right"></i></button>
                </div>
            </div>
            <!-- /ricerca avanzata -->
            {{-- Lista appartamenti --}}
            <div v-if="apartments.length != []" id='apartments-list'>
                <a v-for="apartment in apartments" :href="apartment.route" class="apartment-card" :class="popupSelected == apartment.title? 'selected' : '' ">
                    <div class="img-wrapper">
                        <img class="card__image" :src="apartment.image" :alt="apartment.title">
                        <i v-if="typeof apartment.sponsors !== 'undefined'" class="fa fa-star" aria-hidden="true"></i>
                    </div>
                    <h3 class="card__title">@{{ apartment.title }}</h3>
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
            <div v-else-if="loaded == true" id='apartments-list'>
                <span>Nessun appartamento trovato</span>
            </div>
        </div>
        <div id='map' class='map' :class="{ 'd-block' : showMap }"></div>
    </div>
    
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js" integrity="sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
<script src='https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.13.0/maps/maps-web.min.js'></script>
<script src="{{ asset('js/search.js') }}" defer></script>


@endsection