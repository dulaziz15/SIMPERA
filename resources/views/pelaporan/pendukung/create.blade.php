<div id="modal-master" class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header text-white">
            <h5 class="modal-title" id="tambahPendukungModalLabel">
                <i class="fas fa-user-plus me-2"></i>Tambah Pendukung Laporan
            </h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ asset('/pelaporan/' . $laporan->id_laporan . '/pendukung/store') }}" method="POST"
            id="form-tambah-pendukung">
            @csrf
            <input type="hidden" name="id_laporan" value="{{ $laporan->id_laporan ?? '' }}">
            <div class="card m-3">
                <div class="card-body">
                    <div class="modal-body">
                        <div class="card mb-4">
                            <div class="card-header text-black py-2">
                                <i class="fas fa-search me-2"></i>Cari Pengguna
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Cari Pengguna</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="search-user"
                                                    placeholder="Masukkan nama atau Email Pengguna">
                                                <button class="btn btn-primary" type="button" id="btn-search-user">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-3" id="search-results" style="max-height: 300px; overflow-y: auto;">
                                    <div class="list-group">
                                        <div class="text-center py-4 text-muted">
                                            <i class="fas fa-search fa-2x mb-2"></i>
                                            <p>Masukkan kata kunci pencarian</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card" id="selected-users-card" style="display: none;">
                            <div class="card-header text-black py-2">
                                <i class="fas fa-users me-2"></i>Pengguna Terpilih
                            </div>
                            <div class="card-body">
                                <div id="selected-users" class="d-flex flex-wrap gap-2">
                                </div>
                                <input type="hidden" name="id_pengguna" id="selected-user-id">
                            </div>
                        </div>

                        <div class="row mb-4 mt-4">
                            <div class="col-12">
                                <h5 class="font-size-16 mb-3"><i class="fas fa-exclamation-triangle me-2"></i>Tingkat
                                    Kerusakan
                                </h5>
                                <div class="row" id="radio" role="radiogroup" aria-label="Tingkat Kerusakan">
                                    {{-- Ringan --}}
                                    <div class="col-md-4">
                                        <div class="form-check card-radio">
                                            <input class="form-check-input" type="radio" name="tingkat_kerusakan"
                                                id="ringan" value="1" checked aria-checked="true" role="radio"
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
                                                id="sedang" value="2" aria-checked="false" role="radio"
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
                                                id="berat" value="3" aria-checked="false" role="radio"
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
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="deskripsi" class="form-label">Keterangan Pendukung</label>
                                    <textarea name="deskripsi" id="deskripsi" rows="3" class="form-control"
                                        placeholder="Deskripsi Pendukung Laporan Mengenai Laporan Fasilitas ini" required></textarea>
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
        </form>
    </div>
</div>
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
        border-color: #405189;
        box-shadow: 0 0 8px rgba(64, 81, 137, 0.6);
    }

    .card-radio .form-check-input:checked+label .card-radio-content {
        border-color: #405189;
        background-color: #f7f7ff;
        transform: scale(1.03);
    }

    .card-radio-content {
        will-change: transform, box-shadow;
    }

    .card-radio .form-check-label:focus-visible {
        outline: 3px solid #405189;
        outline-offset: 3px;
        border-radius: 12px;
    }
</style>
<script>
    $(document).ready(function() {
        $('#btn-search-user').click(function() {
            searchUsers();
        });

        $('#search-user').keypress(function(e) {
            if (e.which == 13) {
                searchUsers();
            }
        });

        function searchUsers() {
            const keyword = $('#search-user').val();
            const role = $('#filter-role').val();

            if (keyword.length < 2 && !role) {
                $('#search-results').html(`
                <div class="text-center py-4 text-muted">
                    <i class="fas fa-info-circle fa-2x mb-2"></i>
                    <p>Masukkan minimal 2 karakter atau pilih role</p>
                </div>
            `);
                return;
            }

            $.ajax({
                url: '{{ url('user/search') }}',
                method: 'POST',
                data: {
                    keyword: keyword,
                    role: role
                },
                success: function(response) {
                    if (response.status && response.data && response.data.length > 0) {
                        let html = '';
                        response.data.forEach(user => {
                            html += `
                                <a href="#" class="list-group-item list-group-item-action select-user" 
                                data-user-id="${user.id_pengguna}" data-user-name="${user.nama_pengguna}">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-1">${user.nama_pengguna}</h6>
                                        <small>${user.peran?.nama || 'No role'}</small>
                                    </div>
                                    <p class="mb-1">${user.surel}</p>
                                    <small>${user.nip || 'No NIP'}</small>
                                </a>
                                `;
                        });
                        $('#search-results .list-group').html(html);
                    } else {
                        $('#search-results .list-group').html(`
                            <div class="text-center py-4 text-muted">
                                <i class="fas fa-exclamation-circle fa-2x mb-2"></i>
                                <p>${response.message || 'Tidak ditemukan pengguna yang sesuai'}</p>
                            </div>
                            `);
                    }
                },
                error: function(xhr) {
                    $('#search-results .list-group').html(`
                        <div class="text-center py-4 text-danger">
                            <i class="fas fa-times-circle fa-2x mb-2"></i>
                            <p>Terjadi kesalahan saat memuat data</p>
                        </div>
                    `);
                }
            });
        }

        $(document).on('click', '.select-user', function(e) {
            e.preventDefault();
            const userId = $(this).data('user-id');
            const userName = $(this).data('user-name');

            $('#selected-users').html(`
            <span class="badge bg-success p-2 d-flex align-items-center">
                ${userName}
                <button type="button" class="btn-close btn-close-white ms-2 remove-user" aria-label="Remove"></button>
            </span>
        `);

            $('#selected-user-id').val(userId);
            $('#selected-users-card').show();
        });

        $(document).on('click', '.remove-user', function() {
            $('#selected-users').html('');
            $('#selected-user-id').val('');
            $('#selected-users-card').hide();
        });

        $('#form-tambah-pendukung').submit(function(e) {
            e.preventDefault();

            if (!$('#selected-user-id').val()) {
                Swal.fire({
                    icon: 'error',
                    title: 'Harap memilih pengguna',
                });
                return;
            }

            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    if (response.status) {
                        $('#myModal').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: 'Data Berhasil Ditambahkan',
                            text: response.message
                        });
                        window.location.reload();
                    } else {
                        handleValidationErrors(response);
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        // Handle validation errors
                        const res = xhr.responseJSON;
                        handleValidationErrors(res);
                    } else if (xhr.status === 500 && xhr.responseJSON &&
                        xhr.responseJSON.message.includes('Duplicate entry')) {
                        // Specific handling for duplicate entry
                        Swal.fire({
                            icon: 'error',
                            title: 'Data Ganda',
                            text: 'Pengguna ini sudah mendukung laporan tersebut',
                        });
                    } else {
                        // Generic server error
                        Swal.fire({
                            icon: 'error',
                            title: 'Kesalahan Server',
                            text: xhr.responseJSON?.message ||
                                'Terjadi kesalahan pada server'
                        });
                    }
                }
            });

            // Helper function for validation errors
            function handleValidationErrors(response) {
                $('.invalid-feedback').text('');
                $('.form-control').removeClass('is-invalid');

                if (response.msgField) {
                    $.each(response.msgField, function(prefix, val) {
                        $('#error-' + prefix).text(val[0]);
                        $('#' + prefix).addClass('is-invalid');
                    });
                }

                Swal.fire({
                    icon: 'error',
                    title: 'Validasi Gagal',
                    text: response.message || 'Harap isi data dengan benar.'
                });
            }

            // Function to show existing supporters (optional)
            function showExistingSupporters() {
                $('#supportersModal').modal('show');
            }
        });
    });
</script>
