@extends('layout.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Log Aktivitas Pengguna</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped table-hover table-sm nowrap w-100 dt-responsive" id="table_log">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Pengguna</th>
                        <th>Aktivitas</th>
                        <th>Deskripsi</th>
                        <th>Waktu</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection
@push('scripts')
    @include('log.ajax_handler');
@endpush
