@extends('layout.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <span>{{ $page->title }}</span>
        </div>
        <div class="card-body">
            <table id="table_gedung" class="table table-bordered dt-responsive w-100">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Gedung</th>
                        <th>Nama Gedung</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    @include('gedung.ajax_handler')
@endpush
