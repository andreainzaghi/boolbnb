@extends('layouts.base')

@section('pageTitle')
    BoolBnb - Home
@endsection

@section('mainContent')
<div id="app">

    {{-- hero --}}
    <div class="container">

        <div>
            <form action="{{route('search')}}">
                <div class="form-group">
                    <label for="city">Cerca appartamenti</label>
                    <input class="search" type="text" id="city" placeholder="Inserisci una città" name="city">
                <div class="form-group">
                <button class="btn" type="submit">Cerca</button>
            </form>
        </div>

        <div class="phrase">
            <h1>Lorem ipsum orem ipsum abet</h1>
            <p>Lorem ipsum abet Lorem ipsum</p>
        </div>

    </div>
    {{-- /hero --}}

    {{-- sposored --}}
    <div class="sponsored">
        <div class="card">
            <h4 class="card_title">Lorem ipsum abet</h4>
            <div class="card_image">
                
            </div>
        </div>

        <div class="card">
            <h4 class="card_title">Lorem ipsum abet</h4>
            <div class="card_image">
                
            </div>
        </div>

        <div class="card">
            <h4 class="card_title">Lorem ipsum abet</h4>
            <div class="card_image">
                
            </div>
        </div>

        <div class="card">
            <h4 class="card_title">Lorem ipsum abet</h4>
            <div class="card_image">
                
            </div>
        </div>
    </div>
    {{-- /sposored --}}

    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="{{ asset('js/search.js') }}" defer></script>
</div>  
@endsection