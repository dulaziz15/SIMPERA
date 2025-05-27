@empty($pelaporan)
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Kesalahan</h5>

                <button type="button" class="close" data-dismiss="modal" aria- label="Close"><span
                        aria-hidden="true">&times;</span></button>

            </div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!!!</h5>
                    Data yang anda cari tidak ditemukan
                </div>
                <a href="{{ url('/gedung') }}" class="btn btn-warning">Kembali</a>
            </div>
        </div>
    </div>
@else
    <form action="{{ url('/pelaporan/' . $pelaporan->id_laporan . '/delete') }}" method="POST" id="form-delete">
        @csrf
        @method('DELETE')
        <div id="modal-master" class="modal-dialog modal-lg" role="document">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-exclamation-triangle me-2"></i>Konfirmasi Penghapusan
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger d-flex align-items-center">
                        <i class="fas fa-exclamation-circle fa-2x me-3"></i>
                        <div>
                            <h5 class="alert-heading mb-2">Anda akan menghapus data laporan perbaikan!</h5>
                            <p class="mb-0">Data yang dihapus tidak dapat dikembalikan. Pastikan ini adalah data yang
                                benar.</p>
                        </div>
                    </div>

                    <div class="card border-danger mb-3">
                        <div class="card-header bg-danger text-white py-2">
                            <i class="fas fa-info-circle me-2"></i>Detail Laporan
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Fasilitas:</label>
                                        <p class="form-control-static bg-light p-2 rounded">
                                            {{ $pelaporan->fasilitas->nama }}
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Pelapor:</label>
                                        <p class="form-control-static bg-light p-2 rounded">
                                            {{ $pelaporan->pengguna->profil->nama_lengkap }}
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Status:</label>
                                        <p class="form-control-static bg-light p-2 rounded">
                                            {!! App\Enums\Status\StatusLaporanPerbaikan::tryFrom($pelaporan->status)?->badge() ??
                                                '<span class="badge bg-dark">Unknown</span>' !!}
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Deskripsi:</label>
                                        <p class="form-control-static bg-light p-2 rounded">
                                            {{ $pelaporan->deskripsi ?: 'Tidak ada deskripsi' }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            @if ($pelaporan->pendukung->count() > 0)
                                <div class="alert alert-warning mt-3">
                                    <i class="fas fa-exclamation-triangle me-2"></i>
                                    Laporan ini memiliki <span class="fw-bold">{{ $pelaporan->pendukung->count() }} data pendukung laporan</span>yang juga akan
                                    dihapus.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Batal
                    </button>
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash-alt me-2"></i>Ya, Hapus Data
                    </button>
                </div>
            </div>
        </div>
    </form>
    <script>
        $(document).ready(function() {
            $("#form-delete").validate({
                rules: {},
                submitHandler: function(form) {
                    $.ajax({
                        url: form.action,
                        type: form.method,
                        data: $(form).serialize(),
                        success: function(response) {
                            if (response.status) {
                                $('#myModal').modal('hide');
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: response.message
                                });
                                dataPelaporan.ajax.reload();
                            } else {
                                $('.error-text').text('');
                                $.each(response.msgField, function(prefix, val) {
                                    $('#error-' + prefix).text(val[0]);
                                });
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Terjadi Kesalahan',
                                    text: response.message
                                });
                            }
                        }
                    });
                    return false;
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
@endempty
