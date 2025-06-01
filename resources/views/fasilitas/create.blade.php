<form action="{{ url('/fasilitas/store') }}" method="POST" id="form-tambah" class="needs-validation">
    @csrf
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Fasilitas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body row g-3 p-4">
                <div class="card">
                    <div class="mt-2">
                        <div class="alert alert-warning">
                            <h5><i class="fas fa-exclamation-triangle"></i> Perthatikan!!!</h5>
                            <ul>
                                <li>Pastikan Kategori Gedung Benar</li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="id_kategori" class="form-label">Kategori Fasilitas</label>
                                    <select class="form-control" name="id_kategori" id="id_kategori"
                                        placeholder="This is a search placeholder" required>
                                        <option value="">- Pilih kategori -</option>
                                        @foreach ($kategori as $l)
                                            <option value="{{ $l->id_kategori }}">{{ $l->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback" id="error-id_kategori"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="id_ruangan" class="form-label">Ruangan</label>
                                    <select class="form-control" name="id_ruangan" id="id_ruangan"
                                        placeholder="This is a search placeholder" required>
                                        <option value="">- Pilih Ruangan -</option>
                                        @foreach ($ruangan as $l)
                                            <option value="{{ $l->id_ruangan }}">{{ $l->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback" id="error-id_ruangan"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Nama Fasilitas</label>
                                    <input type="text" name="nama" id="nama" value=""
                                        class="form-control">
                                    <div id="error-nama" class="error-text"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Status Fasilitas</label>
                                    <input type="text" name="status" id="status" class="form-control"
                                        value="">
                                    <div id="error-status" class="error-text"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Gambar Fasilitas</label>
                                    <input type="file" name="gambar" id="gambar" value=""
                                        class="form-control" accept="image/*" onchange="preview()">
                                    <div id="error-gambar" class="error-text"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body p-2">
                                        <img id="frame" src="" alt="Preview gambar" class="img-fluid my-3"
                                            style="max-width: 100%" />
                                    </div>
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
                <button type="button" onclick="clearImage()" class="btn btn-danger">
                    <i class="fas fa-times me-2"></i>Hapus Gambar
                </button>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i>Simpan
                </button>
            </div>
        </div>
    </div>
</form>
<script>
    function preview() {
        frame.src = URL.createObjectURL(event.target.files[0]);
    }

    function clearImage() {
        document.getElementById('gambar').value = null;
        frame.src = "";
    }

    $(document).ready(function() {
        document.querySelectorAll('[data-trigger]').forEach(function(el) {
            new Choices(el, {
                searchEnabled: true,
                itemSelectText: '',
                placeholder: true,
                placeholderValue: el.getAttribute('placeholder') || 'Pilih...'
            });
        });

        $('#form-tambah').validate({
            rules: {
                id_kategori: {
                    required: true
                },
                id_ruangan: {
                    required: true
                },
                nama: {
                    required: true,
                    minlength: 3,
                    maxlength: 50
                },
                status: {
                    required: true,
                },
            },
            messages: {
                id_kategori: "Kategori wajib dipilih.",
                id_ruangan: "Ruangan wajib dipilih.",
                nama: {
                    required: "Nama Gedung wajib diisi.",
                    minlength: "Minimal 3 karakter.",
                    maxlength: "Maksimal 20 karakter."
                },
                status: "Status wajib diisi",
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
                            fasilitasData.ajax.reload();
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
