<form action="{{ url('/ruangan/store') }}" method="POST" id="form-tambah" class="needs-validation">
    @csrf
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Ruangan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body row g-3 p-4">
                <div class="card">
                    <div class="mt-2">
                        <div class="alert alert-warning">
                            <h5><i class="fas fa-exclamation-triangle"></i> Perthatikan!!!</h5>
                            <ul>
                                <li>Pastikan Gedung Benar</li>
                                <li>Pastikan Kode Ruangan Sesuai</li>
                                <li>Pastikan lokasi lantai sesuai</li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="id_gedung" class="form-label">Gedung</label>
                                    <select class="form-control" name="id_gedung" {{-- data-trigger --}} id="id_gedung"
                                        placeholder="This is a search placeholder" required>
                                        <option value="">- Pilih Gedung -</option>
                                        @foreach ($gedung as $l)
                                            <option value="{{ $l->id_gedung }}">{{ $l->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback" id="error-id_gedung"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Kode Ruangan</label>
                                    <input type="text" name="kode" id="kode" value=""
                                        class="form-control">
                                    <div id="error-kode" class="error-text"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Nama Ruangan</label>
                                    <input type="text" name="nama" id="nama" value=""
                                        class="form-control">
                                    <div id="error-nama" class="error-text"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Lantai</label>
                                    <input type="number" name="lantai" id="lantai" class="form-control"
                                        value="">
                                    <div id="error-lantai" class="error-text"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Deskripsi</label>
                                    <textarea name="deskripsi" id="deskripsi" rows="5" class="form-control" required></textarea>
                                    <div id="error-deskripsi" class="error-text"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</form>
<script>
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
                id_gedung: {
                    required: true
                },
                kode: {
                    required: true,
                    minlength: 3,
                    maxlength: 20
                },
                nama: {
                    required: true,
                    minlength: 3,
                    maxlength: 50
                },
                lantai: {
                    required: true,
                    minlength: 1,
                    maxlength: 2
                },
                deskripsi: {
                    required: true,
                    minlength: 5,
                    maxlength: 200
                },
            },
            messages: {
                id_gedung: "Kategori wajib dipilih.",
                kode: {
                    required: "Kode Gedung wajib diisi.",
                    minlength: "Minimal 3 karakter.",
                    maxlength: "Maksimal 20 karakter."
                },
                nama: {
                    required: "Nama Gedung wajib diisi.",
                    minlength: "Minimal 3 karakter.",
                    maxlength: "Maksimal 20 karakter."
                },
                lantai: {
                    required: "Lokasi Lantai wajib diisi",
                    minlength: "minimal 1 karakter",
                    maxlength: "maximal 2 karakter"
                },
                deskripsi: {
                    required: "Deskripsi wajib diisi.",
                    minlength: "Minimal 5 karakter.",
                    maxlength: "Maksimal 200 karakter."
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
                            ruanganData.ajax.reload();
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
