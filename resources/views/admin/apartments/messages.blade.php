@extends('layouts.base-box')

@section('pageTitle')
    {{ $apartment->title }} - Messaggi ricevuti
@endsection

@section('styles')
    <style>
        .ur-wrapper {
            align-content: flex-start;
        }
        .list-group {
            width: 50%;
        }
        .list-group-item span {
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
            -webkit-line-clamp: 1;
            display: inline-block;
        }
        .list-item__top {
            width: 100%;
            display: flex;
            justify-content: space-between;
        }
        .list-item__bottom {
            overflow: hidden;
        }
        .list-item__bottom span {
            width: 100%;
        }
    </style>
@endsection

@section('mainTitle')
    {{ $apartment->title }} - Messaggi ricevuti
@endsection

@section('MainContent')
    <div class="list-group">
        @foreach ( $messages as $message )
            <div class="list-group-item list-group-item-action">
                <div class="list-item__top">
                    <span>{{ $message->email }}</span>
                    <span>{{ $message->date }}</span>
                </div>
                <div class="list-item__bottom mt-2">
                    <span>{{ $message->content }}</span>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@section('script')

@endsection