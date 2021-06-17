@extends('layouts.base-box')

@section('pageTitle')
    BoolBnb - Dashboard
@endsection

@section('mainTitle')
    I miei appartamenti

    @section('fixedElement')
        <div class="add-btn-wrp">
            <a href="{{route('ur.apartments.create')}}" class="my-btn my-btn-primary add_button"> <i class="fas fa-plus"></i></a>
        </div>
    @endsection
@endsection


@section('MainContent')
    <div class="dash-wrapper">

        @foreach ($apartments as $apartment)
            <div class="dash__card">
                <a href="{{ route('ur.apartments.show', ['apartment' => $apartment->id ] ) }}">
                    <!-- card top -->
                    <div class="img__wrapper">
                        <img src="{{asset($apartment['image'])}}" alt="Immagine appartamento">
                    </div>
                    <!-- / card top -->
                    <!-- card bottom -->
                    <div class="card__caption">
                        <h4>{{$apartment['title']}}</h4>
                        <p class="card__caption__desc">{{$apartment['description']}}</p>
                    </div>
                    <!-- card bottom -->
                </a>
            </div>
        @endforeach 
    </div>
@endsection