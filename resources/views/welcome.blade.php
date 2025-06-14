@extends('layout.app')

@section('content')
    @if (Auth::user()->isAdmin())
        @include('dashboard.admin')
    @elseif (Auth::user()->isSarpras())
        @include('dashboard.sarpras')
    @elseif (Auth::user()->isTeknisi())
        @include('dashboard.teknisi')
    @elseif (Auth::user()->isUser())
        @include('dashboard.user')
    @endif
@endsection
@push('scripts')
    
@endpush