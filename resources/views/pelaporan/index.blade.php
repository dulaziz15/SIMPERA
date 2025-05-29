@extends('layout.app')

@section('content')
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card card-h-100">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <span class="text-muted mb-3 lh-1 d-block text-truncate">Jumlah User</span>
                            <h4 class="mb-3">
                                <span class="counter-value" data-target="100">0</span>
                            </h4>
                        </div>

                        
                    </div>
                    <div class="text-nowrap">
                        <span class="badge bg-success-subtle text-success">+$20.9k</span>
                        <span class="ms-1 text-muted font-size-13">Since last week</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card card-h-100">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <span class="text-muted mb-3 lh-1 d-block text-truncate">Jumlah Admin</span>
                            <h4 class="mb-3">
                                <span class="counter-value" data-target="200">0</span>
                            </h4>
                        </div>

                        
                    </div>
                    <div class="text-nowrap">
                        <span class="badge bg-success-subtle text-success"></span>
                        <span class="ms-1 text-muted font-size-13">Since last week</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card card-h-100">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <span class="text-muted mb-3 lh-1 d-block text-truncate">Jumlah Sarpras</span>
                            <h4 class="mb-3">
                                $<span class="counter-value" data-target="865.2">0</span>k
                            </h4>
                        </div>

                        
                    </div>
                    <div class="text-nowrap">
                        <span class="badge bg-success-subtle text-success">+$20.9k</span>
                        <span class="ms-1 text-muted font-size-13">Since last week</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card card-h-100">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <span class="text-muted mb-3 lh-1 d-block text-truncate">Jumlah User</span>
                            <h4 class="mb-3">
                                $<span class="counter-value" data-target="865.2">0</span>k
                            </h4>
                        </div>

                        
                    </div>
                    <div class="text-nowrap">
                        <span class="badge bg-success-subtle text-success">+$20.9k</span>
                        <span class="ms-1 text-muted font-size-13">Since last week</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-outline card-primary">
            <div class="card-header">
                
                <div class="card-tools">
                    <button onclick="modalAction('{{ url('pelaporan/create') }}')"
                        class="btn btn-sm btn-success mt-1">Tambah</button>
                </div>
            </div>
            <div class="card-body" id="user-list">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                <div class="row mb-4">
                    <div class="col-md-12">
                        <div class="col-lg-4">
                            <label class="control-label col-form-label">Filter :</label>
                        </div>
                        <div class="col-lg-4">
                            <select class="form-control" id="id_peran_filter" data-trigger name="id_peran">
                                <option value="">- Semua -</option>
                                
                            </select>
                            <small class="form-text text-muted">peran Pengguna</small>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered table-striped table-hover table-sm nowrap w-100 dt-responsive"
                    id="table_pelaporan">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pelapor</th>
                            <th>Fasilitas</th>
                            <th>Status</th>
                            <th>Periode</th>
                            <th>Waktu Pelaporan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div id="myModal" class="modal fade" tabindex="-1">
            </div>
        </div>
    @endsection
    
    @push('scripts')
        @include('pelaporan.ajaxHandler')
    @endpush
