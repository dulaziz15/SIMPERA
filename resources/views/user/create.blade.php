<form action="{{ url('/user/store-user') }}" method="POST" id="form-tambah" class="needs-validation">
    @csrf
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body row g-3 p-4">
                <div class="card">
                    <div class="mt-2">
                        <div class="alert alert-warning">
                            <h5><i class="fas fa-exclamation-triangle"></i> Perthatikan!!!</h5>
                            <ul>
                                <li>Pastikan Email belum digunakan</li>
                                <li>Password minimal 5 karakter</li>
                                <li>Pastikan Nama Pengguna sudah benar</li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Peran Pengguna</label>
                                    <select name="id_peran" id="id_peran" class="form-select" required>
                                        <option value="">- Pilih Peran -</option>
                                        @foreach ($peran as $l)
                                            <option value="{{ $l->id_peran }}">{{ $l->nama }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback" id="error-id_peran"></div>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Nama Pengguna</label>
                                    <input type="text" name="nama_pengguna" id="nama_pengguna" value=""
                                        class="form-control">
                                    <div id="error-nama_pengguna" class="error-text"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="surel" id="surel" class="form-control"
                                        value="" required>
                                    <div id="error-surel" class="error-text"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Password</label>
                                    <input type="password" name="hash_kata_sandi" id="hash_kata_sandi" value=""
                                        class="form-control" required>
                                    <div id="error-hash_kata_sandi" class="error-text"></div>
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
        $('#form-tambah').validate({
            rules: {
                id_peran: {
                    required: true
                },
                nama_pengguna: {
                    required: true,
                    minlength: 3,
                    maxlength: 20
                },
                surel: {
                    required: true,
                    email: true
                },
                hash_kata_sandi: {
                    required: true,
                    minlength: 5,
                    maxlength: 20
                },
            },
            messages: {
                id_peran: "Peran wajib dipilih.",
                nama_pengguna: {
                    required: "Nama wajib diisi.",
                    minlength: "Minimal 3 karakter.",
                    maxlength: "Maksimal 20 karakter."
                },
                surel: {
                    required: "Email wajib diisi.",
                    email: "Format email tidak valid."
                },
                hash_kata_sandi: {
                    required: "Password wajib diisi.",
                    minlength: "Minimal 5 karakter.",
                    maxlength: "Maksimal 20 karakter."
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
                            dataUser.ajax.reload();
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
