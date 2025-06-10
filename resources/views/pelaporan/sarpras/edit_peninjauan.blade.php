<form action="{{ url('/pelaporan/' . $laporan->id_laporan . '/peninjauan') }}" method="POST" id="form-peninjauan"
    class="needs-validation">
    @csrf
    @method('PUT')
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Data laporan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body row g-3 p-4">
                <div class="card">
                    <div class="mt-2">
                        <div class="alert alert-warning">
                            <h5><i class="fas fa-exclamation-triangle"></i> Perthatikan!!!</h5>
                            <ul>
                                <li>pastikan <b>perkiraan biaya benar</b> karena mempengaruhi rekomendasi perbaikan</li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-md-12">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Fasilitas</label>
                                        <input type="text" name="fasilitas" id="fasilitas"
                                            value="{{ $laporan->fasilitas->nama }}" class="form-control" disabled>
                                        <div id="error-fasilitas" class="error-text"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Perkiraan Biaya</label>
                                    <div class="input-group">
                                        <div class="input-group-text">Rp.</div>
                                        <input type="number" class="form-control" id="perkiraan_biaya" name="perkiraan_biaya"
                                            placeholder="100000" value="{{ $laporan->perkiraan_biaya }}">
                                    </div>
                                    <div id="error-perkiraan_biaya" class="error-text"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <h5 class="font-size-16 mb-3"><i class="fas fa-exclamation-triangle me-2"></i>Tingkat
                                    Kerusakan Peninjauan
                                </h5>
                                <div class="row" id="radio" role="radiogroup" aria-label="Tingkat Kerusakan">
                                    {{-- Ringan --}}
                                    <div class="col-md-4">
                                        <div class="form-check card-radio">
                                            <input class="form-check-input" type="radio" name="tingkat_kerusakan"
                                                id="ringan" value="1" {{ $laporan->kerusakan == 1 ? 'checked' : '' }} aria-checked="true" role="radio"
                                                tabindex="0" />
                                            <label class="form-check-label" for="ringan" tabindex="0"
                                                aria-describedby="desc-ringan" role="button">
                                                <div class="card-radio-content p-3 rounded-3 border">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0">
                                                            <div class="avatar-xs">
                                                                <div
                                                                    class="avatar-title bg-success-subtle text-success rounded-circle">
                                                                    <i class="fas fa-check-circle"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="flex-grow-1 ms-3">
                                                            <h5 class="font-size-14 mb-1">Ringan</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                    <!-- Sedang -->
                                    <div class="col-md-4">
                                        <div class="form-check card-radio">
                                            <input class="form-check-input" type="radio" name="tingkat_kerusakan"
                                                id="sedang" value="2" {{ $laporan->kerusakan == 2 ? 'checked' : '' }} aria-checked="false" role="radio"
                                                tabindex="-1" />
                                            <label class="form-check-label" for="sedang" tabindex="0"
                                                aria-describedby="desc-sedang" role="button">
                                                <div class="card-radio-content p-3 rounded-3 border">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0">
                                                            <div class="avatar-xs">
                                                                <div
                                                                    class="avatar-title bg-warning-subtle text-warning rounded-circle">
                                                                    <i class="fas fa-exclamation-circle"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="flex-grow-1 ms-3">
                                                            <h5 class="font-size-14 mb-1">Sedang</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                    <!-- Berat -->
                                    <div class="col-md-4">
                                        <div class="form-check card-radio">
                                            <input class="form-check-input" type="radio" name="tingkat_kerusakan"
                                                id="berat" value="3" {{ $laporan->kerusakan == 3 ? 'checked' : '' }} aria-checked="false" role="radio"
                                                tabindex="-1" />
                                            <label class="form-check-label" for="berat" tabindex="0"
                                                aria-describedby="desc-berat" role="button">
                                                <div class="card-radio-content p-3 rounded-3 border">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0">
                                                            <div class="avatar-xs">
                                                                <div
                                                                    class="avatar-title bg-danger-subtle text-danger rounded-circle">
                                                                    <i class="fas fa-times-circle"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="flex-grow-1 ms-3">
                                                            <h5 class="font-size-14 mb-1">Berat</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                    <div id="error-tingkat_kerusakan" class="error-text"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-2"></i>Batal
                </button>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i>Simpan
                </button>
            </div>
        </div>
    </div>
</form>
<style>
    .card-radio .form-check-input {
        position: absolute;
        opacity: 0;
        width: 1px;
        height: 1px;
        margin: 0;
        pointer-events: none;
    }

    .card-radio .form-check-label {
        cursor: pointer;
        display: block;
        outline: none;
    }

    .card-radio-content {
        transition: all 0.3s ease;
        cursor: pointer;
        border: 2px solid #ddd;
        border-radius: 12px;
        background-color: white;
        box-shadow: 0 2px 4px rgb(0 0 0 / 0.1);
        padding: 1rem;
        user-select: none;
    }

    .card-radio .form-check-label:hover .card-radio-content,
    .card-radio .form-check-label:focus-visible .card-radio-content {
        border-color: #142353;
        box-shadow: 0 0 8px rgba(13, 64, 231, 0.1);
    }

    .card-radio .form-check-input:checked+label .card-radio-content {
        border-color: #142353;
        background-color: #1b3792b2;
        transform: scale(1.03);
    }

    .card-radio-content {
        will-change: transform, box-shadow;
    }

    .card-radio .form-check-label:focus-visible {
        outline: 3px solid #142353;
        outline-offset: 3px;
        border-radius: 12px;
    }
</style>
    <script>
    $(document).ready(function() {

        $('#form-peninjauan').validate({
            rules: {
                perkiraan_biaya: {
                    required: true
                },
                tingkat_kerusakan: {
                    required: true
                },
            },
            messages: {
                perkiraan_biaya: {
                    required: "Perkiraan Biaya wajib diisi.",
                },
                tingkat_kerusakan: {
                    required: "Tingkat Kerusakan wajib diisi.",
                }
            },
            submitHandler: function(form) {
                const formData = new FormData(form);
                $.ajax({
                    url: form.action,
                    type: form.method,
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                        'Accept': 'application/json'
                    },
                    success: function(response) {
                        if (response.status) {
                            $('#myModal').modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'Data Berhasil Ditambahkan',
                                text: response.message
                            });
                            dataPelaporan.ajax.reload();
                            dataPelaporanPeninjauan.ajax.reload();
                        } else {
                            $('.invalid-feedback').text('');
                            $.each(response.msgField, function(prefix, val) {
                                $('#error-' + prefix).text(val[0]);
                                $('#' + prefix).addClass('is-invalid');
                            });
                            Swal.fire({
                                icon: 'error',
                                title: 'Terjadi Kesalahan',
                                text: response.message
                            });
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            const res = xhr.responseJSON;
                            $('.invalid-feedback').text('');
                            $('.form-control').removeClass('is-invalid');

                            $.each(res.msgField, function(prefix, val) {
                                $('#error-' + prefix).text(val[0]);
                                $('#' + prefix).addClass('is-invalid');
                            });

                            Swal.fire({
                                icon: 'error',
                                title: 'Validasi Gagal',
                                text: res.message ||
                                    'Harap isi data dengan benar.'
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Kesalahan Server',
                                text: 'Terjadi kesalahan tak terduga. Silakan coba lagi.'
                            });
                        }
                    }
                });
                return false;
            },
            errorElement: 'div',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element) {
                $(element).addClass('is-invalid').removeClass('is-valid');
            },
            unhighlight: function(element) {
                $(element).removeClass('is-invalid').addClass('is-valid');
            }
        });

    });
</script>