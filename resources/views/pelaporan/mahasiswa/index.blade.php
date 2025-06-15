@extends('layout.app')

@section('content')
    <div class="container-fluid">
        <div class="card border-0">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0 text-white"><i class="fas fa-search me-2"></i>Cari Fasilitas</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group mb-3"><label for="id_gedung" class="form-label fw-semibold">Pilih
                                Gedung</label><select class="form-select select2" id="id_gedung" name="id_gedung">
                                <option value="">Semua Gedung</option>
                                @foreach ($gedung as $g)
                                    <option value="{{ $g->id_gedung }}">{{ $g->nama }}</option>
                                @endforeach
                            </select></div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group mb-4"><label for="id_ruangan" class="form-label fw-semibold">Pilih
                                Ruangan</label><select class="form-select select2" id="id_ruangan" name="id_ruangan"
                                disabled>
                                <option value="">Semua Ruangan</option>
                            </select></div>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <div class="form-group mb-4">
                            <div class="d-grid gap-2"><button class="btn btn-primary py-2" id="btn-cari"><i
                                        class="fas fa-search me-2"></i>Cari Fasilitas</button></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 text-white"><i class="fas fa-list me-2"></i>Daftar Fasilitas</h5>
                        <span class="badge bg-white text-primary fs-6" id="total-fasilitas">0 Fasilitas</span>
                    </div>
                    <div class="card-body p-3">
                        <div id="search-results" class="row" style="overflow-y: auto;">
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

    <div class="modal fade" id="imageFasilitasModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Foto Fasilitas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img alt="Foto Fasilitas" class="img-fluid" width="80%">
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
                            $('#search-results').append(`@include('pelaporan.mahasiswa.component.daftar_fasilitas')`);
                        });
                    } else {
                        $('#search-results').append(`@include('pelaporan.mahasiswa.component.search_empty')`);
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
