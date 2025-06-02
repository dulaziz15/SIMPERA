@extends('layout.app')

@section('content')
    @if (Auth::user()->isSarpras())
        @include('penugasan.sarpras.show')
    @elseif (Auth::user()->isTeknisi())
        @include('penugasan.teknisi.show')
    @endif
@endsection
