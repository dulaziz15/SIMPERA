@extends('layout.app')

@section('content')
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <!-- card -->
            <div class="card card-h-100">
                <!-- card body -->
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <span class="text-muted mb-3 lh-1 d-block text-truncate">Jumlah Kategori Gedung</span>
                            <h4 class="mb-3">
                                <span class="counter-value" data-target="{{ $content['jumlah_kategori'] }}">0</span>
                            </h4>
                        </div>

                        {{-- <div class="col-6">
                            <div id="mini-chart1" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                        </div> --}}
                    </div>
                    <div class="text-nowrap">
                        <span class="badge bg-success-subtle text-success">+$20.9k</span>
                        <span class="ms-1 text-muted font-size-13">Since last week</span>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->
        <div class="col-xl-3 col-md-6">
            <!-- card -->
            <div class="card card-h-100">
                <!-- card body -->
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <span class="text-muted mb-3 lh-1 d-block text-truncate">Jumlah Gedung</span>
                            <h4 class="mb-3">
                                <span class="counter-value" data-target="{{ $content['jumlah_gedung'] }}">0</span>
                            </h4>
                        </div>

                        {{-- <div class="col-6">
                            <div id="mini-chart1" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                        </div> --}}
                    </div>
                    <div class="text-nowrap">
                        <span class="badge bg-success-subtle text-success"></span>
                        <span class="ms-1 text-muted font-size-13">Since last week</span>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->
        <div class="col-xl-3 col-md-6">
            <!-- card -->
            <div class="card card-h-100">
                <!-- card body -->
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <span class="text-muted mb-3 lh-1 d-block text-truncate">Jumlah Sarpras</span>
                            <h4 class="mb-3">
                                $<span class="counter-value" data-target="865.2">0</span>k
                            </h4>
                        </div>

                        {{-- <div class="col-6">
                            <div id="mini-chart1" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                        </div> --}}
                    </div>
                    <div class="text-nowrap">
                        <span class="badge bg-success-subtle text-success">+$20.9k</span>
                        <span class="ms-1 text-muted font-size-13">Since last week</span>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->
        <div class="col-xl-3 col-md-6">
            <!-- card -->
            <div class="card card-h-100">
                <!-- card body -->
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <span class="text-muted mb-3 lh-1 d-block text-truncate">Jumlah User</span>
                            <h4 class="mb-3">
                                $<span class="counter-value" data-target="865.2">0</span>k
                            </h4>
                        </div>

                        {{-- <div class="col-6">
                            <div id="mini-chart1" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                        </div> --}}
                    </div>
                    <div class="text-nowrap">
                        <span class="badge bg-success-subtle text-success">+$20.9k</span>
                        <span class="ms-1 text-muted font-size-13">Since last week</span>
                    </div>
                </div><!-- end card body -->
            </div><!-- end card -->
        </div><!-- end col -->
    </div>


    <div class="card">
        <div class="card-header">
            <h4 class="card-title">{{ $page->title }}</h4>
        </div><!-- end card header -->
        <div class="card-body">
            <div class="row">
                <div class="col-md-2">
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link mb-2 active" id="kategori-gedung-tab" data-bs-toggle="pill"
                            href="#kategori-gedung" role="tab" onclick="kategoriGedungData.ajax.reload()"
                            aria-controls="kategori-gedung" aria-selected="true">Kategori Gedung</a>
                        <a class="nav-link mb-2" id="gedung-tab" data-bs-toggle="pill" href="#gedung" role="tab"
                            onclick="gedungData.ajax.reload()" aria-controls="gedung" aria-selected="false">Gedung</a>
                        <a class="nav-link mb-2" id="ruangan-tab" data-bs-toggle="pill" href="#ruangan" role="tab"
                            onclick="ruanganData.ajax.reload()" aria-controls="ruangan" aria-selected="false">Ruangan</a>
                    </div>
                </div><!-- end col -->
                <div class="col-md-10">
                    <div class="tab-content text-muted mt-4 mt-md-0" id="v-pills-tabContent">
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
                        <div class="tab-pane fade" id="gedung" role="tabpanel" aria-labelledby="gedung-tab">
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
                                                <select class="form-control" name="id_kategori_gedung"
                                                    data-trigger  
                                                    id="id_kategori_gedung_filter"
                                                    placeholder="This is a search placeholder" required>
                                                    <option value="">- Pilih kategori -</option>
                                                    @foreach ($kategori as $item)
                                                        <option value="{{ $item->id_kategori_gedung}}|{{ $item->kategori_gedung  }}">
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
                        <div class="tab-pane fade" id="ruangan" role="tabpanel" aria-labelledby="ruangan-tab">
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
                                                <select class="form-control" id="id_gedung_filter" data-trigger name="id_gedung">
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
                </div><!--  end col -->
            </div><!-- end row -->
        </div><!-- end card-body -->
    </div><!-- end card -->
    <div id="myModal" class="modal fade" tabindex="-1"></div>
@endsection

@push('scripts')
    @include('gedung.ajax_handler')
@endpush
