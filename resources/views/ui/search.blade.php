@extends('../layouts.app')

@section('content')
<div class="container">
    <div id="app" onload="apartmentsSearch()">

        <input id="cityHidden" type="hidden" value="{{$city}}">

        <h1>Ricerca per - @{{citySearched}}</h1>


        <input type="text" name="city" v-model="city" @@keyup.enter="apartmentsSearch"> <br/>
        <button type="button" class="btn btn-success mt-2" @@click="apartmentsSearch">Cerca</button>
        <button type="button" class="btn btn-success mt-2" @@click="nearBySearch">Nelle vicinanze</button>

        <ul class="list-group mt-5">
            <li v-for="apartment in apartments" class="list-group-item mb-2"> 
            
                    @{{apartment.title}}
                    <p>Città: @{{apartment.city}}</p>
                    <p>Lat: @{{apartment.lat}}</p>
                    <p>Long: @{{apartment.long}}</p>
            </li>
        </ul>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    <script src="{{ asset('js/search.js') }}" defer></script>

</div>
@endsection
