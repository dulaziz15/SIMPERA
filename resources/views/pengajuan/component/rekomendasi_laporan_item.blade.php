<div class="report-card card mb-4 border-0 shadow-sm hover-shadow transition-all">
    <div class="card-body p-4">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-start mb-3">
            <!-- Status and Priority Badges -->
            <div class="d-flex align-items-center gap-2">
                <span
                    class="badge status-badge bg-{{ $item->status->color() }}-subtle text-{{ $item->status->color() }}">
                    {{ $item->status->label() }}
                </span>
                @if ($item->prioritas === 'tinggi')
                    <span class="badge bg-danger bg-opacity-10 text-danger">
                        <i class="fas fa-exclamation-circle me-1"></i> Prioritas Tinggi
                    </span>
                @endif
            </div>

            <!-- Dropdown Menu -->
            <div class="dropdown">
                <button class="btn btn-sm btn-link text-muted p-0" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="fas fa-ellipsis-v"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#"><i class="far fa-bookmark me-2"></i> Simpan</a></li>
                    <li><a class="dropdown-item" href="#"><i class="far fa-share-square me-2"></i> Bagikan</a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item text-danger" href="#"><i class="far fa-flag me-2"></i>
                            Laporkan</a></li>
                </ul>
            </div>
        </div>

        <!-- Facility and Reporter Info -->
        <div class="mb-3">
            <h4 class="h5 mb-2">
                <a href="#" class="text-decoration-none text-dark hover-primary">
                    <i class="fas fa-building text-primary me-2"></i>
                    {{ $item->fasilitas->nama }}
                </a>
            </h4>
            <div class="d-flex flex-wrap gap-3 text-muted small">
                <span class="d-flex align-items-center">
                    <i class="far fa-user me-2"></i>
                    {{ $item->pengguna->profil->nama_lengkap }}
                </span>
                <span class="d-flex align-items-center">
                    <i class="far fa-clock me-2"></i>
                    {{ $item->waktu_pelaporan }}
                </span>
            </div>
        </div>

        <!-- Description Section -->
        <div class="mb-3">
            <p class="mb-1 text-break report-description line-clamp-3">
                {{ $item->deskripsi }}
            </p>
            <a href="#" class="small text-primary read-more-btn" data-bs-toggle="collapse"
                data-bs-target="#desc-{{ $item->id_laporan }}">
                <span class="more">Baca selengkapnya</span>
                <span class="less d-none">Sembunyikan</span>
            </a>
            <div class="collapse" id="desc-{{ $item->id_laporan }}">
                <p class="mt-2 mb-0">{{ $item->deskripsi }}</p>
            </div>
        </div>

        <!-- Tags and Actions Section -->
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
            <!-- Tags -->
            <div class="d-flex flex-wrap gap-2">
                <span class="badge bg-light text-dark hover-bg-primary hover-text-white transition-all">
                    <i class="fas fa-users me-1"></i>
                    {{ $item->pendukung->count() }} Pendukung
                </span>

                @if ($item->kategori)
                    <span class="badge bg-info bg-opacity-10 text-info">
                        <i class="fas fa-tag me-1"></i> {{ $item->kategori->nama }}
                    </span>
                @endif
            </div>

            <!-- Actions -->
            <div class="d-flex flex-wrap gap-2">
                <a href="{{ url('pelaporan/' . $item->id_laporan . '/show') }}"
                    class="btn btn-sm btn-outline-primary rounded-pill px-3 action-btn">
                    <i class="fas fa-eye me-1"></i> Detail
                </a>
                <!-- Button -->
                <button class="btn btn-sm btn-warning rounded-pill px-3 action-btn" data-bs-toggle="modal"
                    data-bs-target="#ajukanModal-{{ $item->id_laporan }}" data-id="{{ $item->id_laporan }}">
                    <i class="fas fa-paper-plane me-1"></i> Ajukan
                </button>

                <!-- Modal -->
                <div class="modal fade" id="ajukanModal-{{ $item->id_laporan }}" tabindex="-1"
                    aria-labelledby="ajukanModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Konfirmasi Pengajuan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-center">
                                <h6>{{ $item->fasilitas->nama }}</h6>
                            </div>
                            <form method="POST" action="{{ url('/pengajuan/' . $item->id_laporan . '/ajukan') }}" id="formAjukan">
                                @csrf
                                <div class="modal-footer justify-content-center">
                                    <button class="btn btn-success" type="submit">Ajukan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@push('styles')
    <style>
        .report-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            border-left: 4px solid var(--bs-primary);
        }

        .report-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.1) !important;
        }

        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .status-badge {
            font-size: 0.75rem;
            padding: 0.35em 0.65em;
        }

        .hover-primary:hover {
            color: var(--bs-primary) !important;
        }

        .hover-bg-primary:hover {
            background-color: var(--bs-primary) !important;
            color: white !important;
        }

        .action-btn {
            transition: all 0.2s ease;
        }

        .progress-thin {
            height: 6px;
        }
    </style>
@endpush

@push('scripts')
    <script>
        $('#formAjukan').validate({
            rules: {
            },
            messages: {
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
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.read-more-btn').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = this.dataset.bsTarget;
                    const collapse = document.querySelector(target);
                    const more = this.querySelector('.more');
                    const less = this.querySelector('.less');

                    if (collapse.classList.contains('show')) {
                        more.classList.remove('d-none');
                        less.classList.add('d-none');
                    } else {
                        more.classList.add('d-none');
                        less.classList.remove('d-none');
                    }
                });
            });
        });
    </script>
@endpush
