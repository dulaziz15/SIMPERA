@extends('layout.app')

@section('content')
    <div class="row">
        <div class="col-md-3" height="100%">
            <div class="card">
                <div class="card-body">
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="horizontal">
                        <div class="">
                            <h6 class="fs-6">Menu Fasilitas</h6>
                        </div>
                        <hr>
                        <div class="menu p-4">
                            <a class="nav-link mb-2 active" id="kategori_fasilitas-tab" data-bs-toggle="pill"
                                href="#kategori_fasilitas" role="tab"
                                onclick="fasilitasDatakategoriFasilitasData.ajax.reload()"
                                aria-controls="kategori_fasilitas" aria-selected="true">Kategori Fasilitas</a>

                            <a class="nav-link mt-auto" id="fasilitas-tab" data-bs-toggle="pill" href="#fasilitas"
                                role="tab" onclick="fasilitasData.ajax.reload()" aria-controls="fasilitas"
                                aria-selected="false">Fasilitas</a>
                        </div>
                        <hr>
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
                                            Mengisi Data Kategori  <span class="text-danger"> * jika belum ada </span>
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
        <div class="col-md-9">
            <div class="tab-content text-muted mt-4 mt-md-0" id="v-pills-tabContent">
                <div class="tab-pane show active fade" id="kategori_fasilitas" role="tabpanel"
                    aria-labelledby="kategori_fasilitas-tab">
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
                <div class="tab-pane fade" id="fasilitas" role="tabpanel" aria-labelledby="fasilitas-tab">
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
                                        <select class="form-control" id="id_gedung_filter" data-trigger name="id_gedung">
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
    <div id="myModal" class="modal fade" tabindex="-1"></div>
@endsection

@push('scripts')
    @include('fasilitas.ajax_handler')
@endpush
