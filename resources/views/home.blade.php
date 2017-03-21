@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        @if(Auth::user()->getRol->idRol == 1)
            <user></user>
        @elseif(Auth::user()->getRol->idRol == 2)
            <super></super>
        @elseif(Auth::user()->getRol->idRol == 3)
            <admin></admin>
        @else
            <h1 class="text-center">NO AUTORIZADO</h1>
        @endif

    </div>
@endsection
