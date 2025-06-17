@extends('layout.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-tools">
                <button onclick="modalAction('{{ url('periode/create') }}')" class="btn btn-sm btn-success mt-1">Tambah</button>
            </div>
        </div>
        <div class="card-body">
            <table id="table_periode"
                class="table table-bordered table-striped table-hover table-sm nowrap w-100 dt-responsive">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Periode</th>
                        <th>Budget Perbaikan</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <div id="myModal" class="modal fade" tabindex="-1"></div>
@endsection

@push('scripts')
    @include('periode.ajax_handler')
@endpush
