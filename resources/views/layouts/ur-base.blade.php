@extends('layouts.base')

@section('mainLay')
    <div class="main__box box-shadow px-0">
        <div class="ur-wrapper">
            <div class="ur-aside">
                <p>Ciao,<br><strong>Nome utente</strong></p>
                <ul class="ur-aside__nav">
                    <li><a href="#" class="active"><i class="fas fa-home"></i>I miei appartamenti</a></li>
                    <li><a href="#"><i class="fas fa-plus"></i>Aggiungi</a></li>
                    <li><a href="#"><i class="fas fa-euro-sign"></i>Sponsorizzazioni</a></li>
                </ul>
            </div>
            <div class="ur-main">
                <div class="container-fluid">
                    @yield('urMainContent')
                </div>
            </div>
        </div>
    </div>
@endsection