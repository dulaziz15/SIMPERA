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
                        <th>Nama Pengguna</th>
                        <th>Judul Laporan</th>
                        <th>Nama Fasilitas</th>
                        <th>Deskripsi</th>
                        <th>Foto</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
   
@endpush