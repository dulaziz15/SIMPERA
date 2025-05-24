@extends('layout.app')

@section('content')
    <div class="card">
        <div class="card-header">
            {{-- <span>{{ $page->title }}</span> --}}
        </div>
        <div class="card-body">
            <table id="table_kategori" class="table table-bordered dt-responsive w-100">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Kategori</th>
                        <th>Nama Kategori</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    @include('kategori.ajax_handler')
@endpush
