<div class="row">
    <div class="col-xl-3 col-md-6">
        <div class="card card-h-100">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-6">
                        <span class="text-muted mb-3 lh-1 d-block text-truncate">Jumlah laporan</span>
                        <h4 class="mb-3">
                            <span class="counter-value" data-target="{{ $laporan->count() }}">0</span>
                        </h4>
                    </div>


                </div>
                <div class="text-nowrap">
                    <span class="ms-1 text-muted font-size-13">Jumlah Laporan dalam sistem</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card card-h-100">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-6">
                        <span class="text-muted mb-3 lh-1 d-block text-truncate">Jumlah laporan Baru</span>
                        <h4 class="mb-3">
                            <span class="counter-value" data-target="{{ $laporan->where('status', App\Enums\Status\StatusLaporanPerbaikan::BARU)->count() }}">0</span>
                        </h4>
                    </div>
                </div>
                <div class="text-nowrap">
                    <span class="ms-1 text-muted font-size-13">Jumlah Laporan baru dalam sistem</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card card-h-100">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-6">
                        <span class="text-muted mb-3 lh-1 d-block text-truncate">Jumlah laporan di verifikasi</span>
                        <h4 class="mb-3">
                            <span class="counter-value"
                                data-target="{{ $laporan->where('status', App\Enums\Status\StatusLaporanPerbaikan::VERIFIKASI)->count() }}">0</span>
                        </h4>
                    </div>
                </div>
                <div class="text-nowrap">
                    <span class="ms-1 text-muted font-size-13">Jumlah Laporan diverifikasi dalam sistem</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card card-h-100">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-6">
                        <span class="text-muted mb-3 lh-1 d-block text-truncate">Jumlah laporan selesai</span>
                        <h4 class="mb-3">
                            <span class="counter-value"
                                data-target="{{ $laporan->where('status', App\Enums\Status\StatusLaporanPerbaikan::SELESAI)->count() }}">0</span>
                        </h4>
                    </div>
                </div>
                <div class="text-nowrap">
                    <span class="ms-1 text-muted font-size-13">Jumlah Laporan selesai dalam sistem</span>
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
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h4 class="card-title mb-0">Laporan yang sudah dilakukan peninjauan</h4>
        </div>
        <div class="card-body" id="user-list">
            <table class="table table-bordered table-striped table-hover table-sm nowrap w-100 dt-responsive"
                id="table_pelaporan_peninjauan">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pelapor</th>
                        <th>Fasilitas</th>
                        <th>Status</th>
                        <th>Periode</th>
                        <th>Waktu Pelaporan</th>
                        <th>Perkiraan Biaya</th>
                        <th>Kerusakan</th>
                        <th>Peninjauan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
        <div id="myModal" class="modal fade" tabindex="-1">
        </div>
    </div>
