@extends('layouts.base')

@section('mainLay')
    <div class="main__box box-shadow px-0">
        <div class="ur-wrapper">
            <div class="titlewrapper">
                <h2 class="ur-main__title">@yield('mainTitle')</h2>
                @yield('fixedElement')
            </div>

            @yield('MainContent')
        </div>
    </div>
@endsection