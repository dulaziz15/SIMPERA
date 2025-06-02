@push('css')
    <style>
        /* Modern Gradient Header with Animation */
        .report-header {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            color: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            position: relative;
            overflow: hidden;
            margin-bottom: 30px;
            transition: all 0.3s ease;
        }

        .report-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0) 70%);
            transform: rotate(30deg);
            transition: all 0.5s ease;
        }

        .report-header:hover::before {
            transform: rotate(45deg);
        }

        /* Enhanced Status Badge */
        .status-badge {
            font-size: 0.85rem;
            padding: 8px 16px;
            border-radius: 50px;
            font-weight: 600;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
        }

        /* Modern Card Design */
        .detail-card {
            border-radius: 12px;
            border: none;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            overflow: hidden;
            margin-bottom: 25px;
            background: white;
            border-top: 3px solid #6a11cb;
        }

        .detail-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15);
        }

        .card-title {
            color: #4a5568;
            font-weight: 600;
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
        }

        .card-title i {
            margin-right: 10px;
            color: #6a11cb;
            font-size: 1.2rem;
        }

        /* Section Dividers */
        hr {
            border: 0;
            height: 1px;
            background: linear-gradient(to right, rgba(106, 17, 203, 0.1), rgba(106, 17, 203, 0.5), rgba(106, 17, 203, 0.1));
            margin: 1.5rem 0;
        }

        /* Info Items */
        .info-item {
            margin-bottom: 1.25rem;
            padding-bottom: 1rem;
            border-bottom: 1px dashed rgba(0, 0, 0, 0.1);
        }

        .info-item:last-child {
            border-bottom: none;
        }

        .info-label {
            font-size: 0.85rem;
            color: #718096;
            font-weight: 500;
            margin-bottom: 0.25rem;
        }

        .info-value {
            font-size: 1rem;
            font-weight: 600;
            color: #2d3748;
        }

        /* Attachment Styling */
        .attachment-container {
            border-radius: 8px;
            overflow: hidden;
            transition: all 0.3s ease;
            border: 1px solid #e2e8f0;
        }

        .attachment-container:hover {
            transform: scale(1.02);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .report-header {
                padding: 20px 15px;
            }

            .card-title {
                font-size: 1.1rem;
            }
        }
    </style>
@endpush

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="report-header mb-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h2 class="mb-1 text-white" style="font-weight: 700;">Detail Laporan</h2>
                        <p class="mb-0" style="opacity: 0.9;">ID: #{{ $laporan->id_laporan }}</p>
                    </div>
                    <span class="status-badge bg-{{ $laporan->status->color() }}"
                        style="background-color: {{ $laporan->status->color() }}!important;">
                        {{ ucfirst($laporan->status->label()) }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card detail-card mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="card-title"><i class="fas fa-user-circle"></i>Informasi Pelapor</h5>
                            <div class="info-item">
                                <div class="info-label">Nama Lengkap</div>
                                <div class="info-value">{{ $laporan->pengguna->profil->nama_lengkap }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Email</div>
                                <div class="info-value">{{ $laporan->pengguna->surel }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Role</div>
                                <div class="info-value">{{ $laporan->pengguna->peran->nama }}</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h5 class="card-title"><i class="fas fa-info-circle"></i>Detail Laporan</h5>
                            <div class="info-item">
                                <div class="info-label">Tanggal Laporan</div>
                                <div class="info-value">{{ $laporan->waktu_pelaporan }}</div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Lokasi</div>
                                <div class="info-value">
                                    {{ $laporan->fasilitas->ruangan->nama }},
                                    {{ $laporan->fasilitas->ruangan->gedung->nama }}
                                </div>
                            </div>
                            <div class="info-item">
                                <div class="info-label">Kategori</div>
                                <div class="info-value">{{ $laporan->fasilitas->kategori->nama }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <h5 class="card-title"><i class="fas fa-file-alt"></i>Deskripsi Masalah</h5>
                        <hr>
                        <div class="problem-description bg-light p-3 rounded">
                            <p class="mb-0">{{ $laporan->deskripsi }}</p>
                        </div>
                    </div>

                    <div class="mt-4">
                        <h5 class="card-title"><i class="fas fa-paperclip"></i>Lampiran</h5>
                        <hr>
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <div class="attachment-container">
                                    <a href="{{ asset('/storage/uploads/laporan/' . $laporan->url_foto) }}"
                                        data-fancybox="gallery">
                                        <img src="{{ asset('/storage/uploads/laporan/' . $laporan->url_foto) }}"
                                            class="img-fluid" style="height: 150px; width: 100%; object-fit: cover;">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if ($laporan->sudahDitugaskan())
            @include('penugasan.sarpras.form_penugasan')
        @else
            @include('penugasan.sarpras.data_penugasan')
        @endif
    </div>
</div>

@push('scripts')
    <script>
        Fancybox.bind("[data-fancybox]", {
        });
    </script>
@endpush
