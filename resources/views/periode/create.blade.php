    <form action="{{ url('periode/store') }}" method="post" id="form-tambah">
        @csrf
        <div id="modal-master" class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body row g-3 p-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Nama Periode</label>
                                        <input type="text" name="nama_periode" id="nama_periode" value=""
                                            class="form-control">
                                        <div id="error-nama_periode" class="error-text"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Budget Perbaikan</label>
                                        <input type="number" name="budget_perbaikan" id="budget_perbaikan"
                                            value="" class="form-control">
                                        <div id="error-budget_perbaikan" class="error-text"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Tanggal Mulai</label>
                                        <input type="date" name="tanggal_mulai" id="tanggal_mulai" value=""
                                            class="form-control">
                                        <div id="error-tanggal_mulai" class="error-text"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Tanggal Selesai</label>
                                        <input type="date" name="tanggal_selesai" id="tanggal_selesai" value=""
                                            class="form-control">
                                        <div id="error-tanggal_selesai" class="error-text"></div>
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
    <script>
        $(document).ready(function() {
            $('#form-tambah').validate({
                rules: {
                    nama_periode: {
                        required: true,
                        minlength: 3,
                        maxlength: 20
                    },
                    budget_perbaikan: {
                        required: true,
                        minlength: 3,
                        maxlength: 20
                    },
                    tanggal_mulai: {
                        required: true,
                    },
                    tanggal_selesai: {
                        required: true,
                    },
                },
                messages: {
                    nama_periode: {
                        required: "Nama Periode harus diisi",
                        minlength: "Nama Periode minimal 3 karakter",
                        maxlength: "Nama Periode maksimal 20 karakter"
                    },
                    budget_perbaikan: {
                        required: "Budget Perbaikan harus diisi",
                        minlength: "Budget Perbaikan minimal 3 karakter",
                        maxlength: "Budget Perbaikan maksimal 20 karakter"
                    },
                    tanggal_mulai: {
                        required: "Tanggal Mulai harus diisi",
                    },
                    tanggal_selesai: {
                        required: "Tanggal Selesai harus diisi",
                    },
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
                                periodeData.ajax.reload();
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
