@extends('../layouts.base-empty')

@section('pageTitle')
    Risultati per - {{$city}}
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/search.css') }}">
    <link rel='stylesheet' type='text/css' href='https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.13.0/maps/maps.css'/>
@endsection

@section('mainLay')
<div id="app" class="mt-20">
    <div class='control-panel'>
        <div class="actions">
            <h1>Risultati per - {{$city}}</h1>
            <div class="search">
                <input type="text" name="city" v-model="city"> <br/>
                {{-- <button type="button" class="btn btn-success mt-2" @@click="apartmentsSearch">Cerca</button>
                <button type="button" class="btn btn-success mt-2" @@click="nearBySearch">Nelle vicinanze</button> --}}
            </div>
            <div class="filter">
                @foreach ( $services as $service )
                    <div class="filter__services">
                        <input type="checkbox" name="{{$service->name}}" value="{{$service->name}}">
                        <label for="{{$service->name}}">{{$service->name}}</label>
                    </div>
                @endforeach
            </div>
        </div>
        <div id='apartments-list'></div>
    </div>
    <!-- Mappa -->
    <div id='map' class='map'></div>
</div>    
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js" integrity="sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
<script src='https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.13.0/maps/maps-web.min.js'></script>
<script src="{{ asset('js/search.js') }}" defer></script>
@endsection