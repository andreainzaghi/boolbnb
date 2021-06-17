@extends('layouts.base-box')

@section('pageTitle')
    BoolBnb - Dashboard
@endsection

@section('mainTitle')
    I miei appartamenti
@endsection

@section('MainContent')

    <div class="add_button">
        <a href="{{route('ur.apartments.create')}}" class="my-btn my-btn-primary"><i class="fas fa-plus"></i><span class="d-none d-md-inline-block">Aggiungi appartamento</span></a>
    </div>

    <div class="dash-wrapper">

        @foreach ($apartments as $item)
            
        <div class="dash__card">
            <a href="#">
                <!-- card top -->
                <div class="img__wrapper">
                    <img src="{{asset($item['image'])}}" alt="Immagine appartamento">
                </div>
                <!-- / card top -->
                <!-- card bottom -->
                <div class="card__caption">
                    <h4>{{$item['title']}}</h4>
                    <p class="card__caption__desc">{{$item['description']}}</p>
                </div>
                <!-- card bottom -->
            </a>
        </div>

        @endforeach
        
    </div>
@endsection