@extends('layouts.base-empty')

@section('pageTitle')
    BoolBnb - Home
@endsection

@section('mainLay')
    {{-- hero --}}

        <div id="app" class="jumbotron jumbotron-fluid">
            <div class="container">

                <div class="search-box">
                    <input v-on:keyup.letters="autocomplete()" v-on:keydown.enter="search()" v-on:keydown.up="selectUp()" v-on:keydown.down="selectDown()" v-model="query" class="search" type="text" id="city" autocomplete="off" placeholder="Dove ti piacerebbe andare?" name="city">
                    <a v-bind:href="searchURL+query" class="btn btn-search" type="submit">Cerca</a>
                    <ul class="results-box" :class=" results.length === 0? 'd-none' : 'd-block'">
                        <li v-on:click="addToQuery($event); results = [];" class="result" :class=" resultSelected == i? 'selected' : '' " v-for="(result, i) in results">@{{ result.address.freeformAddress+', '+result.address.countrySubdivision }}</li>
                    </ul>
                </div>
                
                <div class="phrase">
                    <h1 class="display-4">Scegli la tua prossima destinazione</h1>
                    <p class="lead"></p>
                </div>
            
            </div>
            
        </div>

    {{-- /hero --}}

    {{-- sposored --}}
    @if(isset($sponsored))
    <div class="sponsored">
        
        <?php $count = 0; ?>
        @foreach ($sponsored as $item)
        <?php if($count == 4) break; ?>
        <a href="{{ route('ui.apartments.show', ['id' => $item->id ] ) }}">
            <div class="ap_card">
                <h4 class="card_title">{{$item['title']}}</h4>
                <div class="card_image shadow p-3 mb-5 bg-white rounded">
                    <img class="zoom" src="{{asset('storage/'.$item['image'])}}" alt="Immagine appartamento">
                   
                </div>
            </div>
        </a>
        <?php $count++; ?>
        @endforeach

    </div>
    @endif
    {{-- /sposored --}}
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js" integrity="sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
{{-- <script src="{{ asset('js/app.js') }}" defer></script>
<script src="{{ asset('js/search.js') }}" defer></script> --}}
<script src="{{ asset('js/welcome.js') }}" defer></script>
@endsection