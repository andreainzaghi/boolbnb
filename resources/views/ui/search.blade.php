@extends('../layouts.app')

@section('content')
<div class="container">
    <div id="app">

    {{-- <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div> --}}

    <h1>Ricerca per - {{$city}}</h1>

        <input type="hidden" name="{{$city}}" v-model="city">
    {{-- <div class="form-group">
        <label for="city">Cerca appartamenti</label>
        <input type="text" class="form-control" id="city" placeholder="Inserisci una città" name="city" >
    </div>
    <button type="submit" class="btn btn-primary">Submit</button> --}}

        <ul>
            {{-- <li v-for="apartment in @json($apartments)">
                <h2>{{apartment.title}}</h2>
            </li> --}}
        </ul>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    <script src="{{ asset('js/search.js') }}" defer></script>

</div>
@endsection
