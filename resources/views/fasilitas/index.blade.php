@extends('layout.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <span>{{ $page->title }}</span>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-2">
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link mb-2 active" id="kategori_fasilitas-tab" data-bs-toggle="pill"
                            href="#kategori_fasilitas" role="tab" onclick="fasilitasDatakategoriFasilitasData.ajax.reload()"
                            aria-controls="kategori_fasilitas" aria-selected="true">Kategori Fasilitas</a>

                        <a class="nav-link mb-2" id="fasilitas-tab" data-bs-toggle="pill" href="#fasilitas" role="tab"
                            onclick="fasilitasData.ajax.reload()" aria-controls="fasilitas" aria-selected="false">Fasilitas</a>
                    </div>
                </div><!-- end col -->
                <div class="col-md-10">
                    <div class="tab-content text-muted mt-4 mt-md-0" id="v-pills-tabContent">
                        <div class="tab-pane show active fade" id="kategori_fasilitas" role="tabpanel" aria-labelledby="kategori_fasilitas-tab">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-tools">
                                        <button onclick="modalAction('{{ url('kategori/create') }}')"
                                            class="btn btn-sm btn-success mt-1">Tambah</button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table id="table_kategori_fasilitas" class="table table-bordered table-striped table-hover table-sm nowrap w-100 dt-responsive">
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
                                                <select class="form-control" id="id_gedung_filter" data-trigger
                                                    name="id_gedung">
                                                    <option value="">- Semua -</option>
                                                    
                                                </select>
                                                <small class="form-text text-muted">Gedung</small>
                                            </div>
                                        </div>
                                    </div>
                                    <table id="table_fasilitas" class="table table-bordered table-striped table-hover table-sm nowrap w-100 dt-responsive">
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
