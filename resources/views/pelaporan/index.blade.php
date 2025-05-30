@extends('layout.app')

@section('content')
    @if (Auth::user()->isUser())
        @include('pelaporan.mahasiswa.index')
    @elseif (Auth::user()->isAdmin())
        @include('pelaporan.admin.index')
    @endif
@endsection

@push('scripts')
    @include('pelaporan.ajaxHandler')
@endpush
