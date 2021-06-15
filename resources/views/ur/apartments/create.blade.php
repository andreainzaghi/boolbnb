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

    <form action="{{route('ur.apartments.store')}}" method="POST">
        @method('POST')
        @csrf
        <!-- titolo -->
        <div class="form-group">
            <label for="title">Titolo</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="{{ old('title') }}">
        </div>
        <!-- / titolo -->

        <!-- descrizione -->
        <div class="form-group">
            <label for="description">Descrizione</label>
            <textarea class="form-control" name="description" id="description" rows="10" placeholder="description">{{ old('description') }}</textarea>
        </div>
        <!-- / descrizione -->

        <!-- mq -->
        <div class="form-group">
            <label for="mq">Superficie</label>
            <input type="mq" class="form-control" id="mq" name="mq" placeholder="mq" value="{{ old('mq') }}">
        </div>
        <!-- / mq -->

        <!-- rooms -->
        <div class="form-group">
            <label for="rooms">Numero Camere</label>
            <input type="rooms" class="form-control" id="rooms" name="rooms" placeholder="rooms" value="{{ old('rooms') }}">
        </div>
        <!-- / rooms -->

        <!-- beds -->
        <div class="form-group">
            <label for="beds">Numero letti</label>
            <input type="text" class="form-control" id="beds" name="beds" value="{{ old('beds') }}" placeholder="beds">
        </div>
        <!-- / beds -->

        <!-- bathroom -->
        <div class="form-group">
            <label for="bathroom">Numero Bagni</label>
            <input type="bathroom" class="form-control" id="bathroom" name="bathrooms" placeholder="bathroom" value="{{ old('bathroom') }}">
        </div>
        <!-- / bathroom -->

        <!-- image -->
        <div class="form-group">
            <label for="image">Scegli immagine</label>
            <input type="file" class="form-control-file" id="image">
        </div>
        <!-- / image -->

        <!-- address -->
        <div class="form-group">
            <label for="address">Indirizzo</label>
            <input type="address" class="form-control" id="address" name="address" placeholder="address" value="{{ old('address') }}">
        </div>
        <!-- / address -->

        <!-- address -->
        <div class="form-group">
            <label for="lat">lat</label>
            <input type="lat" class="form-control" id="lat" name="lat" placeholder="lat" value="{{ old('lat') }}">
        </div>
        <!-- / lat -->

        <!-- address -->
        <div class="form-group">
            <label for="long">long</label>
            <input type="long" class="form-control" id="long" name="long" placeholder="long" value="{{ old('long') }}">
        </div>
        <!-- / address -->

        <!-- city -->
        <div class="form-group">
            <label for="city">Città</label>
            <input type="city" class="form-control" id="city" name="city" placeholder="city" value="{{ old('city') }}">
        </div>
        <!-- / city -->
        
        <!-- visible -->
        <div class="form-check ">
            <input class="form-check-input" type="checkbox" id="visible" name="visible" value="1" {{ old('visible') ? 'checked' : '' }}>
            <label class="form-check-label" for="visible">Visibile</label>
        </div>
        <!-- /visible -->


        <!-- service -->
        <h3 class="mt-3">Servizi</h3>
        @foreach ($services as $service)
            <div class="form-check ">
                <input class="form-check-input" type="checkbox" value="{{ $service->id }}" id="{{ $service->name }}" name="services[]" {{ old('name') ? 'checked' : '' }}>
                <label class="form-check-label" for="{{ $service->name }}">{{ $service->name }}</label>
            </div>
        @endforeach
        <!-- /service --> 

        <button type="submit" class="btn btn-primary mb-5 mt-5">Crea</button>
    </form>
@endsection

@section('script')
    
@endsection