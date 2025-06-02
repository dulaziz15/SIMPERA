<!-- Card Detail Penugasan -->
<div class="col-lg-4">
    <div class="card detail-card mb-4">
            <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="card-title mb-0 text-primary">
                    <i class="fas fa-clipboard-check me-2"></i>Detail Penugasan
                </h5>
                <span class="badge bg-{{ $laporan->penugasan->status_color }} rounded-pill px-3 py-1">
                    {{ ucfirst($laporan->penugasan->status) }}
                </span>
            </div>

            <hr class="my-3 border-top-2 border-primary opacity-25">

            <div class="technician-section mb-4 p-3 bg-light rounded-3">
                <h6 class="section-title text-muted mb-3">
                    <i class="fas fa-user-tie me-2"></i>Teknisi
                </h6>
                <div class="d-flex align-items-center">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="{{ asset('storage/foto_profil/' . $laporan->penugasan->teknisi->profil->foto_profil) ?? '/images/default-avatar.png' }}"
                                class="ratio ratio-1x1 rounded-3 overflow-hidden bg-light"
                                width="100px" alt="{{ $laporan->penugasan->teknisi->nama }}">
                        </div>
                        <div class="col-md-6 align-self-center">
                            <h5 class="mb-1">{{ $laporan->penugasan->teknisi->nama_pengguna }}</h5>
                            <p class="text-muted small mb-0">
                                <i class="fas fa-id-card me-1"></i>
                                {{ $laporan->penugasan->teknisi->peran->nama ?? 'Teknisi' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="timeline-section mb-4">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="timeline-item p-3 bg-light rounded-3">
                            <h6 class="text-muted small mb-2">
                                <i class="fas fa-calendar-start me-2"></i>Tanggal Mulai
                            </h6>
                            <p class="mb-0 fw-semibold">
                                {{ \Carbon\Carbon::parse($laporan->penugasan->tanggal_mulai)->translatedFormat('d F Y') }}
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="timeline-item p-3 bg-light rounded-3">
                            <h6 class="text-muted small mb-2">
                                <i class="fas fa-calendar-check me-2"></i>Tanggal Selesai
                            </h6>
                            <p class="mb-0 fw-semibold">
                                {{ \Carbon\Carbon::parse($laporan->penugasan->tanggal_selesai)->translatedFormat('d F Y') }}
                            </p>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="timeline-item p-3 bg-light rounded-3">
                            <h6 class="text-muted small mb-2">
                                <i class="fas fa-clock me-2"></i>Durasi
                            </h6>
                            <p class="mb-0 fw-semibold">
                                {{ $laporan->penugasan->durasi() }} hari
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="notes-section mb-4">
                <h6 class="text-muted small mb-2">
                    <i class="fas fa-sticky-note me-2"></i>Catatan
                </h6>
                <div class="card border-0 bg-light p-3">
                    <div class="card-body p-0">
                        {!! nl2br(e($laporan->penugasan->catatan_perubahan)) !!}
                    </div>
                </div>
            </div>

            @if ($laporan->penugasan->status === 'dalam penugasan')
                <div class="action-buttons d-grid gap-2 mt-4">
                    <button class="btn btn-success rounded-pill py-2" data-bs-toggle="modal"
                        data-bs-target="#updateProgressModal">
                        <i class="fas fa-tasks me-1"></i> Update Progress
                    </button>
                    <button class="btn btn-outline-danger rounded-pill py-2" data-bs-toggle="modal"
                        data-bs-target="#batalkanPenugasanModal">
                        <i class="fas fa-times me-1"></i> Batalkan
                    </button>
                </div>
            @endif
        </div>
    </div>

</div>

@push('styles')
    <style>
        .detail-card {
            border-radius: 12px;
            overflow: hidden;
        }

        .tech-avatar {
            width: 60px;
            height: 60px;
            object-fit: cover;
        }

        .section-title {
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }

        .timeline-item {
            transition: all 0.3s ease;
        }

        .timeline-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
        }

        .action-buttons .btn {
            transition: all 0.3s ease;
        }

        @media (max-width: 768px) {
            .tech-avatar {
                width: 50px;
                height: 50px;
            }

            .card-body {
                padding: 1.25rem;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        function updateProgressValue(val) {
            document.getElementById('progressInput').value = val;
        }

        document.getElementById('progressInput').addEventListener('input', function(e) {
            document.getElementById('progressRange').value = e.target.value;
        });
    </script>
@endpush
