@extends('layouts.base-box')

@section('pageTitle')
    BoolBnb - Modifica struttura
@endsection

@section('mainTitle')
    Modifica appartamento
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

    <form action="{{route('admin.apartments.update', ['apartment' => $apartment->id])}}" method="POST" class="myForm" enctype="multipart/form-data"  method="POST">
        @method('PUT')
        @csrf
        <!-- titolo -->
        <div class="form-group input__title">
            <label for="title">Nome</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Inserisci nome dell’appartamento" value="{{ old('title', $apartment->title) }}">
        </div>
        <!-- / titolo -->

        <!-- descrizione -->
        <div class="form-group">
            <label for="description">Descrizione</label>
            <textarea class="form-control" name="description" id="description" rows="10" placeholder="Inserisci descrizione">{{ old('description', $apartment->description) }}</textarea>
        </div>
        <!-- / descrizione -->

        <div class="inlineInput numericInput multiple-inline">
            <!-- mq -->
            <div class="form-group">
                <label for="mq">Superficie</label>
                <input type="mq" class="form-control" id="mq" name="mq" placeholder="25" value="{{ old('mq', $apartment->mq) }}">
            </div>
            <!-- / mq -->

            <!-- rooms -->
            <div class="form-group">
                <label for="rooms">N. stanze</label>
                <input type="rooms" class="form-control" id="rooms" name="rooms" placeholder="1" value="{{ old('rooms', $apartment->rooms) }}">
            </div>
            <!-- / rooms -->

            <!-- beds -->
            <div class="form-group">
                <label for="beds">N. posti letto</label>
                <input type="text" class="form-control" id="beds" name="beds" value="{{ old('beds', $apartment->beds) }}" placeholder="1">
            </div>
            <!-- / beds -->

            <!-- bathroom -->
            <div class="form-group">
                <label for="bathroom">N. bagni</label>
                <input type="bathroom" class="form-control" id="bathroom" name="bathrooms" placeholder="1" value="{{ old('bathrooms', $apartment->bathrooms) }}">
            </div>
            <!-- / bathroom -->
        </div>
        

        <!-- image -->
        <div class="form-group upload-wrapper">
            <label for="image">Carica un immagine</label>
            <input type="file" class="form-control-file upload-image" id="image" name="image" {{ old('image', $apartment->image) }}>
        </div>
        <!-- / image -->

        <h3>Posizione</h3>
        <div class="inlineInput">
            <!-- address -->
            <div class="form-group input__address">
                <label for="address">Indirizzo</label>
                <input type="address" class="form-control" id="address" name="address" placeholder="Inserisci indirizzo" v-on:input=" city !== '' ? geolocate() : ''" v-model="address" value="{{ old('address', $apartment->address) }}">
            </div>
            <!-- / address -->

            <!-- city -->
            <div class="form-group input__city">
                <label for="city">Città</label>
                <input type="city" class="form-control" id="city" name="city" placeholder="Inserisci città" v-on:input=" city !== '' ? geolocate() : ''" v-model="city" value="{{ old('city', $apartment->city) }}">
            </div>
            <!-- / city -->
        </div>

        <!-- lat -->
        <div class="form-group">
            <label for="lat">Latitudine</label>
            <input type="lat" class="form-control" id="lat" name="lat" placeholder="Generazione automatica" v-model="lat" value="{{ old('lat', $apartment->lat) }}">
        </div>
        <!-- / lat -->

        <!-- long -->
        <div class="form-group">
            <label for="long">Longitudine</label>
            <input type="long" class="form-control" id="long" name="long" placeholder="Generazione automatica" v-model="long" value="{{ old('long', $apartment->long) }}">
        </div>
        <!-- / long -->

        <!-- service -->
        <h3>Servizi</h3>
        <div class="services__wrapper">
            @foreach ($services as $service)
                <div class="form-check services">
                    <label class="form-check-label" for="{{ $service->name }}">{{ $service->name }}
                        <input class="form-check-input" type="checkbox" value="{{ old('id',$service->id) }}" id="{{ $service->name }}" name="services[]" {{ old('name', $apartment->services->contains($service)) ? 'checked' : '' }}>
                        <span class="checkmark"></span>
                    </label>
                </div>
            @endforeach
        </div>
        <!-- /service --> 

        <!-- visible -->
        <div class="form-check checkVisible">
            <label class="form-check-label" for="visible">Visibile</label>
            <input class="form-check-input" type="checkbox" id="visible" name="visible" value="1" {{ old('visible', $apartment->visible) ? 'checked' : '' }}>
            <span class="toogle"></span>
        </div>
        <!-- /visible -->

        <div class="text-right">
            <button type="submit" class="my-btn my-btn-primary submit">Modifica appartamento</button>
        </div>
    </form>
@endsection

@section('script')
    
@endsection