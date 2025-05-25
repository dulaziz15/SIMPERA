<form action="{{ url('/fasilitas/' . $fasilitas->id_fasilitas . '/update') }}" method="POST" id="form-edit" class="needs-validation">
    @csrf
    @method('PUT')
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Data Fasilitas</h5>
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
                                    <select class="form-control" name="id_kategori" 
                                    {{-- data-trigger --}}
                                        id="id_kategori" placeholder="This is a search placeholder" required>
                                        <option value="">- Pilih kategori -</option>
                                        @foreach ($kategori as $l)
                                            <option value="{{ $l->id_kategori}}" {{ $l->id_kategori == $fasilitas->id_kategori ? 'selected' : '' }}>{{ $l->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback" id="error-id_kategori"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="id_ruangan" class="form-label">Ruangan</label>
                                    <select class="form-control" name="id_ruangan" 
                                    {{-- data-trigger --}}
                                        id="id_ruangan" placeholder="This is a search placeholder" required>
                                        <option value="">- Pilih Ruangan -</option>
                                        @foreach ($ruangan as $l)
                                            <option value="{{ $l->id_ruangan }}" {{ $l->id_ruangan == $fasilitas->id_ruangan ? 'selected' : '' }}>{{ $l->nama }}
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
                                    <input type="text" name="nama" id="nama" value="{{ $fasilitas->nama }}"
                                        class="form-control">
                                    <div id="error-nama" class="error-text"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Status Fasilitas</label>
                                    <input type="text" name="status" id="status" class="form-control"
                                        value="{{ $fasilitas->status }}">
                                    <div id="error-status" class="error-text"></div>
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

        $('#form-edit').validate({
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
