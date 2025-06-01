@extends('layout.app')

@section('content')
    @if (Auth::user()->isSarpras())
        @include('penugasan.sarpras.index')
    @elseif (Auth::user()->isTeknisi())
        @include('penugasan.teknisi.index')
    @endif
@endsection
