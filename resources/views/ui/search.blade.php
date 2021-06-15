@extends('../layouts.ui-base')

@section('pageTitle')
    Risultati per - {{$city}}
@endsection

@section('mainLay')
<div class="container">
    <div id="app">

        <h1>Risultati per - {{$city}}</h1>

        <input type="text" name="city" v-model="city"> <br/>
        <button type="button" class="btn btn-success mt-2" @@click="apartmentsSearch">Cerca</button>
        <button type="button" class="btn btn-success mt-2" @@click="nearBySearch">Nelle vicinanze</button>


    </div>

    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    <script src="{{ asset('js/search.js') }}" defer></script>

</div>
@endsection
