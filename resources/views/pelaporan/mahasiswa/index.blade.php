@extends('layout.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 text-white"><i class="fas fa-search me-2"></i>Cari Fasilitas</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <!-- Filter Gedung -->
                            <div class="form-group">
                                <label for="id_gedung" class="form-label fw-semibold">Pilih Gedung</label>
                                <select class="form-select select2" id="id_gedung" name="id_gedung">
                                    <option value="">Semua Gedung</option>
                                    @foreach ($gedung as $g)
                                        <option value="{{ $g->id_gedung }}">{{ $g->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-4">
                            <!-- Filter Ruangan -->
                            <div class="form-group">
                                <label for="id_ruangan" class="form-label fw-semibold">Pilih Ruangan</label>
                                <select class="form-select select2" id="id_ruangan" name="id_ruangan" disabled> 
                                    <option value="">Semua Ruangan</option>
                                </select>
                            </div>
                        </div>
                        <!-- Tombol Cari -->
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary py-2" id="btn-cari">
                                <i class="fas fa-search me-2"></i>Cari Fasilitas
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 text-white"><i class="fas fa-list me-2"></i>Daftar Fasilitas</h5>
                        <span class="badge bg-white text-primary fs-6" id="total-fasilitas">0 Fasilitas</span>
                    </div>
                    <div class="card-body p-3">
                        <div id="search-results" class="list-group list-group-flush"
                            style="overflow-y: auto;">
                            <div class="list-group-item border-0 text-center py-5">
                                <div class="text-muted mb-3">
                                    <i class="fas fa-search fa-3x opacity-25"></i>
                                </div>
                                <h5 class="text-muted mb-2">Mulai pencarian fasilitas</h5>
                                <p class="small text-muted">Pilih gedung dan ruangan untuk melihat daftar fasilitas</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- modal image fasilitas --}}
    <div class="modal fade" id="imageFasilitasModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Foto Laporan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img alt="Foto Laporan"
                        class="img-fluid">
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#id_ruangan').prop('disabled', true);

            $('#id_gedung').change(function() {
                const idGedung = $(this).val();
                if (idGedung) {
                    $('#id_ruangan').prop('disabled', false).val('');
                    $('#id_fasilitas').empty().append('<option value="">- Pilih Fasilitas -</option>').prop(
                        'disabled', true);
                    $.get('/pelaporan/ruangan-by-gedung/' + idGedung, function(data) {
                        // alert(data);
                        $('#id_ruangan').empty().append(
                            '<option value="">- Pilih Ruangan -</option>');
                        $.each(data, function(key, value) {
                            $('#id_ruangan').append('<option value="' + value.id_ruangan +
                                '">' + value.nama + '</option>');
                        });
                    }).fail(function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Gagal memuat data ruangan'
                        });
                    });
                } else {
                    $('#id_ruangan').empty().append('<option value="">- Pilih Ruangan -</option>').prop(
                        'disabled', true);
                }
            });

            // Proses pencarian
            $('#btn-cari').click(function() {
                const idGedung = $('#id_gedung').val();
                const idRuangan = $('#id_ruangan').val();

                $.get('/fasilitas/search', {
                    gedung: idGedung,
                    ruangan: idRuangan
                }, function(response) {
                    fasilitasList = response.data;
                    $('#search-results').empty();
                    $('#total-fasilitas').text((fasilitasList.length ?? '0') + ' Fasilitas');
                    if (fasilitasList.length > 0) {
                        fasilitasList.forEach((fasilitas, index) => {
                            console.log(fasilitas);
                            $('#search-results').append(`
                          <div
                                class="list-group-item example-result-item border-start border-1 border-primary rounded-4 m-3">
                                <div class="d-flex w-100 justify-content-between align-items-start">
                                    <div class="flex-grow-1">
                                        <div class="d-flex align-items-center mb-1">
                                            <h6 class="mb-0 fw-semibold me-2 bg-secondary p-2 bg-light rounded" id="nama_fasilitas">${fasilitas.nama}
                                            </h6>
                                            <span class="badge bg-primary bg-opacity-10 text-primary small"
                                                id="id_fasilitas">${'#' + fasilitas.id}</span>
                                        </div>

                                        <div class="row small g-2 mb-1">
                                            <div class="col-md-6">
                                                <span class="text-muted">Lokasi:</span>
                                                <span class="ms-1" id="Lokasi Fasilitas">${fasilitas.ruangan.nama + ', ' + fasilitas.ruangan.gedung.nama}</span>
                                            </div>
                                            <div class="col-md-6">
                                                <span class="text-muted">Kategori:</span>
                                                <span class="ms-1" id="katagori_fasilitas">${fasilitas.kategori.nama}</span>
                                            </div>
                                        </div>

                                        <div class="row small g-2">
                                            <div class="col-md-6">
                                                <span class="text-muted">Status:</span>
                                                <span
                                                    class="badge bg-primary bg-opacity-10 text-primary mb-2 rounded-pill px-3 py-1"
                                                    id="kondisi_fasilitas">
                                                    <i class="fas fa-exclamation-circle me-1"></i>${fasilitas.status}
                                                </span>
                                            </div>
                                            <div class="col-md-6">
                                                <span class="text-muted">Tahun:</span>
                                                <span class="ms-1" id="tahun_pencatatan">${fasilitas.dibuat}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column align-items-end ms-3">
                                        <span class="badge bg-primary bg-opacity-10 text-primary mb-2 rounded-pill px-3 py-1"
                                            id="kondisi_fasilitas">${fasilitas.status}
                                            <i class="fas fa-exclamation-circle me-1"></i>
                                        </span>
                                        <span
                                            class="badge bg-${fasilitas.memiliki_laporan_aktif.style} bg-opacity-10 text-${fasilitas.memiliki_laporan_aktif.style} small rounded-pill px-2"
                                            id="status_fasilitas">${fasilitas.memiliki_laporan_aktif.status}
                                        </span>
                                    </div>
                                </div>

                                <div class="mt-3 pt-2 border-top d-flex justify-content-between align-items-center">
                                    <div class="small text-muted" id="update_fasilitas">
                                        <i class="far fa-clock me-1"></i>${'Terakhir diperiksa: ' + fasilitas.terakhir_update}
                                    </div>
                                    <div class="d-flex gap-2">
                                        <button class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye me-1"></i>Detail
                                        </button>
                                        <button class="btn btn-sm btn-outline-primary"
                                            data-fasilitas-id="${fasilitas.id}" onclick="modalImageFasilitas('{{ asset('template/assets/images/logo.png') }}')">
                                            <i class="fas fa-image me-1"></i>Foto
                                    </div>
                                </div>
                            </div>
                            `);
                        });
                    } else {
                        $('#search-results').append(` 
                            <div class="list-group-item border-0 text-center py-5">
                                <div class="text-muted mb-3">
                                    <i class="fas fa-exclamation-circle fa-3x opacity-25"></i>
                                </div>
                                <h5 class="text-muted mb-2">Fasilitas Tidak ditemukan</h5>
                                <p class="small text-muted">Fasilitas yang anda cari tidak ditemukan <br> Harap cek kembali filter anda</p>
                            </div>
                        `);
                    }
                });
            });
        });

        function modalImageFasilitas(imageUrl) {
            $('#imageFasilitasModal').modal('show');
            $('#imageFasilitasModal img').attr('src', imageUrl);
        }
    </script>
@endpush
