@extends('layouts.email-box')


@section('pageTitle')
<h1>Hai ricevuto nuovo nuovo messaggio</h1>
@endsection

@section('MainContent')
<div>
    <h1>Appartmento: {{$apartment->title}}</h1>
    <p>Email mittente: {{$email_author }}</p>
    <p>{{$content}}</p>
    <a href="{{route('admin.apartments.show', ['apartment' => $apartment])}}">Link al tuo appartamento</a> <br/>
</div>

@endsection