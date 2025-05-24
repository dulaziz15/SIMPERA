@extends('layout.app')

@section('content')
    <div class="card">
        <div class="card-header">
            {{-- <span>{{ $page->title }}</span> --}}
        </div>
        <div class="card-body">
            <table id="table_fasilitas" class="table table-bordered dt-responsive w-100">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Fasilitas</th>
                        <th>Nama Fasilitas</th>
                        <th>Kode Kategori</th>
                        <th>Nama Gedung</th>
                        <th>Lokasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    @include('fasilitas.ajax_handler')
@endpush
