@extends('layout.app')

@section('content')
    @if (Auth::user()->isAdmin() || Auth::user()->isSarpras() || Auth::user()->isTeknisi())
        @include('dashboard.admin')
    @elseif (Auth::user()->isUser())
        @include('dashboard.user')
    @endif
@endsection
@push('scripts')
    
@endpush