<!-- Kolom Penugasan dan Riwayat -->
<div class="col-lg-4">
    @if ($laporan->status->value === 'diverifikasi')
        <div class="card detail-card mb-4">
            <div class="card-body">
                <h5 class="card-title"><i class="fas fa-user-tie me-2"></i>Penugasan Teknisi</h5>
                <hr>

                <form action="{{ url('/penugasan/' . $laporan->id_laporan . '/create') }}" method="POST"
                    id="form-penugasan">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Cari Teknisi</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="search_teknisi"
                                placeholder="Masukkan nama atau Email Pengguna">
                            <button class="btn btn-primary" type="button" id="btn-search_teknisi">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                        <div id="error-id_teknisi" class="error-text"></div>
                    </div>

                    <div class="my-3" id="search-results" style="max-height: 300px; overflow-y: auto;">
                        <div class="list-group">
                            <div class="text-center py-4 text-muted">
                                <i class="fas fa-search fa-2x mb-2"></i>
                                <p>Masukkan kata kunci pencarian</p>
                            </div>
                        </div>
                    </div>

                    <div class="card mt-3" id="selected-users-card" style="display: none;">
                        <div class="card-header text-black py-2">
                            <i class="fas fa-users me-2"></i>Pengguna Terpilih
                        </div>
                        <div class="card-body">
                            <div id="selected-users" class="d-flex flex-wrap gap-2">
                            </div>
                            <input type="hidden" name="id_teknisi" id="id_teknisi">
                        </div>
                        <div id="error-id_teknisi" class="error-text"></div>
                    </div>

                    <div class="form-group">
                        <div class="mb-3 mt-3">
                            <label class="form-label">Tanggal Mulai</label>
                            <input type="date" class="form-control" name="tanggal_mulai" required>
                        </div>
                        <div id="error-tanggal_mulai" class="error-text"></div>
                    </div>

                    <div class="form-group">
                        <div class="mb-3 mt-3">
                            <label class="form-label">Tanggal Selesai</label>
                            <input type="date" class="form-control" name="tanggal_selesai" required>
                        </div>
                        <div id="error-tanggal_selesai" class="error-text"></div>
                    </div>

                    <div class="form-group">
                        <div class="mb-3 mt-3">
                            <label class="form-label">Catatan</label>
                            <textarea class="form-control" name="catatan_perubahan" id="catatan_perubahan" rows="3"
                                placeholder="Berikan instruksi khusus..."></textarea>
                        </div>
                        <div id="error-catatan_perubahan" class="error-text"></div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-paper-plane me-2"></i> Berikan Tugas
                    </button>
                </form>
            </div>
        </div>
        <input type="hidden" id="teknisi" value="{{ App\Enums\Peran\PeranEnums::TEKNISI->label() }}">
    @endif

    <div class="card detail-card">
        <div class="card-body">
            <h5 class="card-title"><i class="fas fa-history me-2"></i>Riwayat Status</h5>
            <hr>
            {{-- <div class="timeline">
                        @foreach ($laporan->statusHistories as $history)
                        <div class="timeline-item {{ $loop->last ? 'current' : '' }}">
                            <div class="timeline-point"></div>
                            <div class="timeline-content">
                                <div class="d-flex justify-content-between">
                                    <h6>{{ ucfirst($history->status) }}</h6>
                                    <small class="text-muted">{{ $history->created_at->diffForHumans() }}</small>
                                </div>
                                @if ($history->notes)
                                <p class="text-muted mb-0">{{ $history->notes }}</p>
                                @endif
                                @if ($history->user)
                                <small class="text-muted">Oleh: {{ $history->user->name }}</small>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div> --}}
        </div>
    </div>
</div>
@push('scripts')
    <script>
        $(document).ready(function() {

            $('#btn-search_teknisi').click(function() {
                searchUsers();
            });

            $('#search_teknisi').keypress(function(e) {
                if (e.which == 13) {
                    searchUsers();
                }
            });

            function searchUsers() {
                const keyword = $('#search_teknisi').val();
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
                        role: $('#teknisi').val()
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

                $('#id_teknisi').val(userId);
                $('#selected-users-card').show();
                $('#error-id_teknisi').text('').hide();
            });

            $(document).on('click', '.remove-user', function() {
                $('#selected-users').html('');
                $('#id_teknisi').val('');
                $('#selected-users-card').hide();
                $('#error-id_teknisi').text('Teknisi wajib dipilih').show();
            });

            $('#form-penugasan').validate({
                rules: {
                    id_teknisi: {
                        required: true,
                    },
                    catatan_perubahan: {
                        required: true,
                    },
                    tanggal_mulai: {
                        required: true,
                    },
                    tanggal_selesai: {
                        required: true,
                    },
                },
                messages: {
                    id_teknisi: {
                        required: "Teknisi wajib dipilih",
                    },
                    catatan_perubahan: {
                        required: "catatan wajib diisi",
                    },
                    tanggal_mulai: {
                        required: "Tanggal Mulai wajib diisi",
                    },
                    tanggal_selesai: {
                        required: "Tanggal Selesai wajib diisi",
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
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Data Berhasil Ditambahkan',
                                    text: response.message,
                                    timer: 1000,
                                    showConfirmButton: false
                                }).then(function() {
                                    window.location.reload();
                                });
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
                    element.closest('#radio').append(error);
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
@endpush
