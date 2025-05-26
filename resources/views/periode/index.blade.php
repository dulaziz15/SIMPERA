@extends('layout.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <span>{{ $page->title }}</span>
        </div>

        <div class="btn-group">
            <select class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuClickableInside"
                data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                <option value="" class="mdi mdi-chevron-down">-- Pilih Periode -- </option>
            </select>
        </div>

        <div class="card-body">
            <table id="table_gedung" class="table table-bordered dt-responsive w-100">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Fasilitas</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    @include('periode.ajax_handler')
@endpush