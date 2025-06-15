@extends('layout.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="attention mt-auto ">
                        <div class="card bg-warning border-warning text-white">
                            <div class="card-body p-3">
                                <h5 class="mb-3 text-white fw-bold"><i class="fas fa-info-circle me-2"></i>Alur
                                    Pengisian Data Ruangan</h5>
                                <ul class="ps-3" style="list-style-type: none;">
                                    <li class="mb-2">
                                        <span class="badge bg-white text-primary me-2">1</span>
                                        Pastikan Kategori Gedung sudah dibuat
                                    </li>
                                    <li class="mb-2">
                                        <span class="badge bg-white text-primary me-2">2</span>
                                        Mengisi Data Kategori <span class="text-danger"> * jika belum ada </span>
                                    </li>
                                    <li class="mb-2">
                                        <span class="badge bg-white text-primary me-2">3</span>
                                        Mengisi Data Gedung
                                    </li>
                                    <li class="mb-2">
                                        <span class="badge bg-white text-primary me-2">4</span>
                                        Mengisi Data Ruangan
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
                            <button class="nav-link active" id="kategori-gedung-tab" data-bs-toggle="tab"
                                data-bs-target="#kategori-gedung" type="button" role="tab"
                                aria-controls="kategori-gedung" aria-selected="true"
                                onclick="kategoriGedungData.ajax.reload()">
                                <i class="fas fa-clipboard-check me-2"></i>Kategori Gedung
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="data-gedung-tab" data-bs-toggle="tab" data-bs-target="#data-gedung"
                                type="button" role="tab" aria-controls="data-gedung" aria-selected="false"
                                onclick="gedungData.ajax.reload()">
                                <i class="fas fa-hands-helping me-2"></i>Gedung
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="data-ruangan-tab" data-bs-toggle="tab"
                                data-bs-target="#data-ruangan" type="button" role="tab" aria-controls="data-ruangan"
                                aria-selected="true" onclick="ruanganData.ajax.reload()">
                                <i class="fas fa-clipboard-check me-2"></i>Ruangan
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="laporanTabContent">
                        <div class="tab-pane fade show active" id="kategori-gedung" role="tabpanel"
                            aria-labelledby="kategori-gedung-tab">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-tools">
                                        <button onclick="modalAction('{{ url('kategori_gedung/create') }}')"
                                            class="btn btn-sm btn-success mt-1">Tambah</button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table id="table_kategori_gedung"
                                        class="table table-bordered table-striped table-hover table-sm nowrap w-100 dt-responsive">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kategori Gedung</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="data-gedung" role="tabpanel" aria-labelledby="data-gedung-tab">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-tools">
                                        <button onclick="modalAction('{{ url('gedung/create') }}')"
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
                                                <select class="form-control" name="id_kategori_gedung" data-trigger
                                                    id="id_kategori_gedung_filter"
                                                    placeholder="This is a search placeholder" required>
                                                    <option value="">- Pilih kategori -</option>
                                                    @foreach ($kategori as $item)
                                                        <option
                                                            value="{{ $item->id_kategori_gedung }}|{{ $item->kategori_gedung }}">
                                                            {{ $item->kategori_gedung }}</option>
                                                    @endforeach
                                                </select>
                                                <small class="form-text text-muted">Kategori Gedung</small>
                                            </div>
                                        </div>
                                    </div>
                                    <table id="table_gedung"
                                        class="table table-bordered table-striped table-hover table-sm nowrap w-100 dt-responsive">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kode Gedung</th>
                                                <th>Nama Gedung</th>
                                                <th>Deskripsi</th>
                                                <th>Kategori Gedung</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="data-ruangan" role="tabpanel" aria-labelledby="data-ruangan-tab">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-tools">
                                        <button onclick="modalAction('{{ url('ruangan/create') }}')"
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
                                                    @foreach ($gedung as $item)
                                                        <option value="{{ $item->id_gedung }}|{{ $item->nama }}">
                                                            {{ $item->nama }}</option>
                                                    @endforeach
                                                </select>
                                                <small class="form-text text-muted">Gedung</small>
                                            </div>
                                        </div>
                                    </div>
                                    <table id="table_ruangan"
                                        class="table table-bordered table-striped table-hover table-sm nowrap w-100 dt-responsive">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kode Ruangan</th>
                                                <th>Nama Ruangan</th>
                                                <th>Lokasi</th>
                                                <th>Gedung</th>
                                                <th>Deskripsi</th>
                                                <th>aksi</th>
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
    <!-- Modal -->
    <div id="myModal" class="modal fade" tabindex="-1"></div>
@endsection

@push('scripts')
    @include('gedung.ajax_handler')
@endpush
