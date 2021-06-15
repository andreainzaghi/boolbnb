@extends('layouts.base-empty')

@section('pageTitle')
    BoolBnb - Home
@endsection

@section('mainLay')
    {{-- hero --}}

        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <form action="{{route('search')}}">
                    <input class="search" type="text" id="city" placeholder="Inserisci una città" name="city">
                    <button class="btn" type="submit">Cerca</button>
                </form>
                <div class="phrase">
                    <h1 class="display-4">Scegli la tua prossima destinazione</h1>
                    <p class="lead">Lorem ipsum abet Lorem ipsum</p>
                </div>
            </div>
        </div>

    {{-- /hero --}}

    {{-- sposored --}}
    <div class="sponsored">
        <div class="ap_card">
            <h4 class="card_title">Lorem ipsum abet</h4>
            <div class="card_image shadow p-3 mb-5 bg-white rounded">
                <img src="" alt="">
            </div>
        </div>

        <div class="ap_card">
            <h4 class="card_title">Lorem ipsum abet</h4>
            <div class="card_image shadow p-3 mb-5 bg-white rounded">
                <img src="" alt="">
            </div>
        </div>

        <div class="ap_card">
            <h4 class="card_title">Lorem ipsum abet</h4>
            <div class="card_image shadow p-3 mb-5 bg-white rounded">
                <img src="" alt="">
            </div>
        </div>

        <div class="ap_card">
            <h4 class="card_title">Lorem ipsum abet</h4>
            <div class="card_image shadow p-3 mb-5 bg-white rounded">
                <img src="" alt="">
            </div>
        </div>
    </div>
    {{-- /sposored --}}
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
<script src="{{ asset('js/app.js') }}" defer></script>
<script src="{{ asset('js/search.js') }}" defer></script>
@endsection