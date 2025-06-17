<div class="card p-4">
    <div class="card-body p-4">
        <div class="container px-0">
            <!-- Timeline Header -->
            <div class="row text-center justify-content-center mb-5">
                <div class="col-xl-8 col-lg-10">
                    <h2 class="fw-bold text-primary">Proses Pengajuan Laporan</h2>
                    <p class="text-muted mb-0">Berikut adalah alur proses pengajuan laporan perbaikan fasilitas.</p>
                </div>
            </div>

            <!-- Timeline Section -->
            <div class="row mb-5">
                <div class="col">
                    <div class="timeline-container px-3">
                        <div class="timeline-steps">
                            <!-- Step 1 -->
                            <div class="timeline-step completed">
                                <div class="timeline-content" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Laporan diajukan oleh pengguna">
                                    <div class="timeline-connector-left"></div>
                                    <div class="inner-circle bg-primary text-white">
                                        <i class="fas fa-file-alt"></i>
                                    </div>
                                    <div class="timeline-connector-right"></div>
                                    <p class="h6 mt-3 mb-1 fw-semibold">Pelaporan Kerusakan</p>
                                    <p class="small text-muted mb-2">Mahasiswa, dosen, ataupun tendik bisa melakukan pelaporan kerusakan fasilitas yang ditemukan</p>
                                </div>
                            </div>

                            <!-- Step 2 -->
                            <div class="timeline-step completed">
                                <div class="timeline-content" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Laporan ditinjau oleh petugas sarpras">
                                    <div class="timeline-connector-left"></div>
                                    <div class="inner-circle bg-primary text-white">
                                        <i class="fas fa-eye"></i>
                                    </div>
                                    <div class="timeline-connector-right"></div>
                                    <p class="h6 mt-3 mb-1 fw-semibold">Peninjauan Sarpras</p>
                                    <p class="small text-muted mb-2">Laporan yang masuk akan ditinjau oleh sarana prasarana</p>
                                </div>
                            </div>

                            <!-- Step 3 -->
                            <div class="timeline-step completed">
                                <div class="timeline-content" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Laporan diverifikasi oleh admin">
                                    <div class="timeline-connector-left"></div>
                                    <div class="inner-circle bg-primary text-white">
                                        <i class="fas fa-check-circle"></i>
                                    </div>
                                    <div class="timeline-connector-right"></div>
                                    <p class="h6 mt-3 mb-1 fw-semibold">Verifikasi Admin</p>
                                    <p class="small text-muted mb-2">Laporan yang telah ditinjau akan diverifikasi admin untuk penanganan lebih lanjut</p>
                                </div>
                            </div>

                            <!-- Step 4 -->
                            <div class="timeline-step completed">
                                <div class="timeline-content" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Proses Penugasan dan Perbaikan">
                                    <div class="timeline-connector-left"></div>
                                    <div class="inner-circle bg-primary text-white">
                                        <i class="fas fa-tools"></i>
                                    </div>
                                    <div class="timeline-connector-right"></div>
                                    <p class="h6 mt-3 mb-1 fw-semibold">Proses Perbaikan</p>
                                    <p class="small text-muted mb-2">Laporan yang telah diverifikasi akan dilakukan proses perbaikan</p>
                                </div>
                            </div>

                            <!-- Step 5 -->
                            <div class="timeline-step completed">
                                <div class="timeline-content" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Proses selesai">
                                    <div class="timeline-connector-left"></div>
                                    <div class="inner-circle bg-primary text-white">
                                        <i class="fas fa-check-double"></i>
                                    </div>
                                    <div class="timeline-connector-right"></div>
                                    <p class="h6 mt-3 mb-1 fw-semibold">Selesai</p>
                                    <p class="small text-muted mb-2">Proses perbaikan telah diselesaikan oleh teknisi</p>
                                </div>
                            </div>

                            <!-- Step 6 -->
                            <div class="timeline-step completed">
                                <div class="timeline-content" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="Pemberian Feedback">
                                    <div class="timeline-connector-left"></div>
                                    <div class="inner-circle bg-primary text-white">
                                        <i class="fas fa-clipboard-check"></i>
                                    </div>
                                    <div class="timeline-connector-right"></div>
                                    <p class="h6 mt-3 mb-1 fw-semibold">Pemberian Feedback</p>
                                    <p class="small text-muted mb-2">Bagi pelapor memberikan feedback dari hasil perbaikan yang dilakukan</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="row mb-5">
                <div class="col-md-4">
                    <div class="card border-0 h-100">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center">
                                <div class="bg-primary-soft rounded p-3 me-3">
                                    <i class="fas fa-file-alt text-primary fs-4"></i>
                                </div>
                                <div>
                                    <h5 class="mb-1 fw-semibold">{{ $laporanSaya->count() ?? 0 }}</h5>
                                    <p class="text-muted small mb-2">Laporan Yang Anda Buat</p>
                                    <a href="{{ url('tracking') }}" class="btn btn-sm btn-link px-0 text-primary">Lihat
                                        Detail →</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border-0 h-100">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center">
                                <div class="bg-info-soft rounded p-3 me-3">
                                    <i class="fas fa-thumbs-up text-info fs-4"></i>
                                </div>
                                <div>
                                    <h5 class="mb-1 fw-semibold">{{ $laporanDidukung->count() ?? 0 }}</h5>
                                    <p class="text-muted small mb-2">Laporan Yang Anda Dukung</p>
                                    <a href="{{ url('tracking') }}" class="btn btn-sm btn-link px-0 text-info">Lihat
                                        Detail →</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border-0 h-100">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center">
                                <div class="bg-success-soft rounded p-3 me-3">
                                    <i class="fas fa-check-circle text-success fs-4"></i>
                                </div>
                                <div>
                                    <h5 class="mb-1 fw-semibold">{{ $laporanSelesai->count() ?? 0 }}</h5>
                                    <p class="text-muted small mb-2">Laporan Selesai Diperbaiki</p>
                                    <a href="{{ url('tracking') }}"
                                        class="btn btn-sm btn-link px-0 text-success">Lihat Detail →</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-5">
                <div class="col">
                    <div class="text-center">
                        <a href="{{ url('pelaporan') }}" class="btn btn-primary btn-pill px-4 py-3 fw-bold shadow-sm">
                            <i class="fas fa-plus-circle me-2"></i> Buat Laporan Baru
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Custom Variables */
    :root {
        --primary: #4361ee;
        --primary-soft: rgba(67, 97, 238, 0.1);
        --success: #4cc9f0;
        --success-soft: rgba(76, 201, 240, 0.1);
        --info: #3a86ff;
        --info-soft: rgba(58, 134, 255, 0.1);
    }

    /* Timeline Container */
    .timeline-container {
        position: relative;
        padding: 2rem 0;
        margin: 0 auto;
        overflow-x: auto;
    }

    /* Timeline Steps */
    .timeline-steps {
        display: flex;
        justify-content: space-between;
        position: relative;
        min-width: 800px;
    }

    /* Timeline Step */
    .timeline-step {
        position: relative;
        flex: 1;
        text-align: center;
        min-width: 120px;
    }

    /* Timeline Content */
    .timeline-content {
        width: 100%;
        text-align: center;
        padding: 0 0.5rem;
        position: relative;
    }

    /* Inner Circle */
    .inner-circle {
        border-radius: 50%;
        height: 60px;
        width: 60px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background-color: white;
        border: 3px solid var(--primary);
        color: var(--primary);
        font-size: 1.25rem;
        position: relative;
        z-index: 2;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        margin: 0 auto;
    }

    /* Active Step */
    .timeline-step.active .inner-circle {
        background-color: var(--success);
        border-color: var(--success);
        transform: scale(1.1);
    }

    /* Timeline Connectors */
    .timeline-connector-left,
    .timeline-connector-right {
        position: absolute;
        top: 30px;
        height: 3px;
        background-color: var(--primary);
        opacity: 0.2;
        z-index: 1;
    }

    .timeline-connector-left {
        left: 0;
        right: 50%;
    }

    .timeline-connector-right {
        left: 50%;
        right: 0;
    }

    /* Completed Steps */
    .timeline-step.completed .inner-circle {
        background-color: var(--primary);
        border-color: var(--primary);
        color: white;
    }

    .timeline-step.completed .timeline-connector-left,
    .timeline-step.completed .timeline-connector-right {
        opacity: 0.5;
    }

    /* Button Styles */
    .btn-primary-soft {
        background-color: var(--primary-soft);
        color: var(--primary);
    }

    .btn-success-soft {
        background-color: var(--success-soft);
        color: var(--success);
    }

    .btn-rounded {
        border-radius: 50px;
    }

    /* Responsive Adjustments */
    @media (max-width: 991.98px) {
        .timeline-container {
            padding: 1.5rem 0;
        }

        .inner-circle {
            height: 50px;
            width: 50px;
            font-size: 1rem;
        }

        .timeline-connector-left,
        .timeline-connector-right {
            top: 25px;
        }
    }

    @media (max-width: 767.98px) {
        .timeline-steps {
            flex-direction: column;
            align-items: center;
            min-width: auto;
        }

        .timeline-step {
            margin-bottom: 2rem;
            width: 100%;
            max-width: 220px;
        }

        .timeline-connector-left,
        .timeline-connector-right {
            display: none;
        }

        .timeline-step:not(:last-child)::after {
            content: "";
            position: absolute;
            top: 100%;
            left: 50%;
            height: 2rem;
            width: 3px;
            background-color: var(--primary);
            opacity: 0.2;
            transform: translateX(-50%);
        }

        .timeline-step.completed:not(:last-child)::after {
            opacity: 0.5;
        }
    }

    .btn-pill {
        border-radius: 50px;
        padding-left: 1.5rem;
        padding-right: 1.5rem;
        transition: all 0.3s ease;
    }

    .btn-pill:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(67, 97, 238, 0.25);
    }
</style>

<script>
    // Initialize tooltips
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Bootstrap tooltips
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>
