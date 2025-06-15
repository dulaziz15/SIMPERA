@extends('layout.app')

@section('content')
    <div class="row">
        <div class="col-mmd-12">
            <div class="card">
                <div class="card-body">
                    <div class="attention mt-auto ">
                        <div class="card bg-warning border-warning text-white">
                            <div class="card-body p-3">
                                <h5 class="mb-3 text-white fw-bold"><i class="fas fa-info-circle me-2"></i>Alur
                                    Pengisian Data Fasilitas</h5>
                                <ul class="ps-3" style="list-style-type: none;">
                                    <li class="mb-2">
                                        <span class="badge bg-white text-primary me-2">1</span>
                                        Pastikan Kategori Fasilitas sudah dibuat
                                    </li>
                                    <li class="mb-2">
                                        <span class="badge bg-white text-primary me-2">2</span>
                                        Mengisi Data Kategori <span class="text-danger"> * jika belum ada </span>
                                    </li>
                                    <li class="mb-2">
                                        <span class="badge bg-white text-primary me-2">3</span>
                                        Mengisi Data Fasilitas
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs nav-tabs-white mt-3" id="laporanTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="kategori-fasilitas-tab" data-bs-toggle="tab"
                                data-bs-target="#kategori-fasilitas" type="button" role="tab"
                                aria-controls="kategori-fasilitas" aria-selected="true"
                                onclick="kategoriFasilitasData.ajax.reload()">
                                <i class="fas fa-clipboard-check me-2"></i>Kategori Fasilitas
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="data-fasilitas-tab" data-bs-toggle="tab"
                                data-bs-target="#data-fasilitas" type="button" role="tab"
                                aria-controls="data-fasilitas" aria-selected="false"
                                onclick="fasilitasData.ajax.reload()">
                                <i class="fas fa-hands-helping me-2"></i>Fasilitas
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="laporanTabContent">
                        <div class="tab-pane fade show active" id="kategori-fasilitas" role="tabpanel"
                            aria-labelledby="kategori-fasilitas-tab">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-tools">
                                        <button onclick="modalAction('{{ url('kategori/create') }}')"
                                            class="btn btn-sm btn-success mt-1">Tambah</button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table id="table_kategori_fasilitas"
                                        class="table table-bordered table-striped table-hover table-sm nowrap w-100 dt-responsive">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kode Kategori</th>
                                                <th>Nama Kategori</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade show" id="data-fasilitas" role="tabpanel"
                            aria-labelledby="data-fasilitas-tab">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-tools">
                                        <button onclick="modalAction('{{ url('fasilitas/create') }}')"
                                            class="btn btn-sm btn-success mt-1">Tambah</button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row mb-4">
                                        <div class="col-md-12">
                                            <div class="col-lg-4">
                                                <label class="control-label col-form-label">Filter :</label>
                                            </div>
                                            <div class="col-lg-4">
                                                <select class="form-control" id="id_gedung_filter" data-trigger
                                                    name="id_gedung">
                                                    <option value="">- Semua -</option>

                                                </select>
                                                <small class="form-text text-muted">Gedung</small>
                                            </div>
                                        </div>
                                    </div>
                                    <table id="table_fasilitas"
                                        class="table table-bordered table-striped table-hover table-sm nowrap w-100 dt-responsive">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="myModal" class="modal fade" tabindex="-1"></div>
@endsection

@push('scripts')
    @include('fasilitas.ajax_handler')
@endpush
