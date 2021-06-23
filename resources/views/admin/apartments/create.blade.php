@extends('layouts.base-box')

@section('pageTitle')
    BoolBnb - Aggiungi struttura
@endsection

@section('mainTitle')
    Aggiungi un nuovo appartamento
@endsection

@section('MainContent')
    <!-- stampo, se ci sono, lista di errori -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <!-- /stampo, se ci sono, lista di errori -->

    <form id="vue-app" action="{{route('admin.apartments.store')}}" method="POST" class="myForm" enctype="multipart/form-data">
        @method('POST')
        @csrf
        <!-- titolo -->
        <div class="form-group input__title">
            <label for="title">Nome</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Inserisci nome dell’appartamento" value="{{ old('title') }}" required>
        </div>
        <!-- / titolo -->

        <!-- descrizione -->
        <div class="form-group">
            <label for="description">Descrizione</label>
            <textarea class="form-control" name="description" id="description" rows="10" placeholder="Inserisci descrizione" required>{{ old('description') }}</textarea>
        </div>
        <!-- / descrizione -->

        <div class="inlineInput numericInput multiple-inline">
            <!-- mq -->
            <div class="form-group">
                <label for="mq">Superficie</label>
                <input type="mq" class="form-control" id="mq" name="mq" placeholder="25" value="{{ old('mq') }}" required>
            </div>
            <!-- / mq -->

            <!-- rooms -->
            <div class="form-group">
                <label for="rooms">N. stanze</label>
                <input type="rooms" class="form-control" id="rooms" name="rooms" placeholder="1" value="{{ old('rooms') }}" required>
            </div>
            <!-- / rooms -->

            <!-- beds -->
            <div class="form-group">
                <label for="beds">N. posti letto</label>
                <input type="text" class="form-control" id="beds" name="beds" value="{{ old('beds') }}" placeholder="1" required>
            </div>
            <!-- / beds -->

            <!-- bathroom -->
            <div class="form-group">
                <label for="bathroom">N. bagni</label>
                <input type="bathroom" class="form-control" id="bathroom" name="bathrooms" placeholder="1" value="{{ old('bathrooms') }}" required>
            </div>
            <!-- / bathroom -->
        </div>
        

        <!-- image -->
        <div class="form-group upload-wrapper">
            <label for="image">Carica un immagine</label>
            <input type="file" class="form-control-file upload-image" id="image" name="image">
        </div>
        <!-- / image -->

        <h3>Posizione</h3>
        <div class="inlineInput">
            <!-- address -->
            <div class="form-group input__address">
                <label for="address">Indirizzo</label>
                <input type="address" class="form-control" id="address" name="address" placeholder="Inserisci indirizzo" v-on:input=" city !== '' ? geolocate() : ''" v-model="address" value="{{ old('address') }}" required>
            </div>
            <!-- / address -->

            <!-- city -->
            <div class="form-group input__city">
                <label for="city">Città</label>
                <input type="city" class="form-control" id="city" name="city" placeholder="Inserisci città" v-on:input=" city !== '' ? geolocate() : ''" v-model="city" value="{{ old('city') }}" required>
            </div>
            <!-- / city -->
        </div>

        <!-- lat -->
        <div class="form-group">
            <label for="lat">Latitudine</label>
            <input type="lat" class="form-control disabled" id="lat" name="lat" placeholder="Generazione automatica" v-model="lat" value="{{ old('lat') }}" required>
        </div>
        <!-- / lat -->

        <!-- long -->
        <div class="form-group">
            <label for="long">Longitudine</label>
            <input type="long" class="form-control" id="long" name="long" placeholder="Generazione automatica" v-model="long" value="{{ old('long') }}" required>
        </div>
        <!-- / long -->

        <!-- service -->
        <h3>Servizi</h3>
        <div class="services__wrapper">
            @foreach ($services as $service)
                <div class="form-check services">
                    <label class="form-check-label" for="{{ $service->name }}">{{ $service->name }}
                        <input class="form-check-input" type="checkbox" value="{{ $service->id }}" id="{{ $service->name }}" name="services[]" {{ in_array($service->id, old('services', [])) ? 'checked' : '' }}>
                        <span class="checkmark"></span>
                    </label>
                </div>
            @endforeach
        </div>
        <!-- /service --> 

        <!-- visible -->
        <div class="form-check checkVisible">
            <label class="form-check-label" for="visible">Visibile</label>
            <input class="form-check-input" type="checkbox" id="visible" name="visible" value="1" {{ old('visible') ? 'checked' : '' }}>
            <span class="toogle"></span>
        </div>
        <!-- /visible -->

        <div class="text-right">
            <button type="submit" class="my-btn my-btn-primary submit">Aggiungi appartamento</button>
        </div>
    </form>
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js" integrity="sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    <script src="{{ asset('js/ur-create-edit.js') }}"></script>
@endsection