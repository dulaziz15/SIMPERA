@extends('layout.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <span>{{ $page->title }}</span>
        </div>
        <div class="card-body">
            <table id="table_fasilitas" class="table table-bordered table-sm dt-responsive w-100">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Fasilitas</th>
                        <th>Kategori fasilitas</th>
                        <th>Ruangan</th>
                        <th>Gedung</th>
                        <th>Status</th>
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
