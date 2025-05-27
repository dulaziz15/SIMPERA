@extends('layout.app')

@section('content')
    <div class="container-fluid">
        <div class="row align-items-center" style="height: 100vh;">
            <div class="col-lg-12">
                <div class="print-header">
                    <div class="row">
                        <div class="col-2">
                            <img src="{{ asset('template/assets/images/polinema.png') }}" alt="Foto Laporan" class="img-fluid"
                                width="70px">
                        </div>
                        <div class="col-8">
                            <h3>Politeknik Negeri Malang</h3>
                            <p>Jl. Soekarno Hatta No. 9, Jatimulyo, Kec. Lowokwaru, Kota Malang, Jawa Timur 65141</p>
                        </div>
                        <div class="col-2"></div>
                    </div>
                    <hr>
                    <h4 class="mt-3">Laporan Perbaikan Fasilitas</h4>
                    <p>Tanggal Cetak: {{ now()->format('d M Y') }}</p>
                </div>

                <div class="card border-0">
                    <div class="card-header bg-primary text-white py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('template/assets/images/polinema.png') }}" alt="Logo" height="32"
                                    class="me-3">
                                <h4 class="mb-0 text-white">Detail Laporan Perbaikan</h4>
                            </div>
                            <div>
                                <span
                                    class="badge bg-light text-dark fs-6">#{{ str_pad($laporan->id_laporan, 6, '0', STR_PAD_LEFT) }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        <div class="d-flex flex-column flex-md-row justify-content-between mb-4">
                            <div class="mb-3 mb-md-0">
                                <h5 class="fw-bold mb-2">{{ $laporan->pengguna->profil->nama_lengkap }}</h5>
                                <div class="d-flex align-items-center text-muted">
                                    <i class="fas fa-envelope me-2"></i>
                                    <span>{{ $laporan->pengguna->surel }}</span>
                                </div>
                            </div>
                            <div class="text-md-end">
                                <div class="d-flex flex-column">
                                    <span class="text-muted">Tanggal Laporan</span>
                                    <span class="fw-bold fs-5">
                                        {{ \Carbon\Carbon::parse($laporan->waktu_pelaporan)->translatedFormat('l, j F Y') }}
                                    </span>
                                    <small class="text-muted">
                                        {{ \Carbon\Carbon::parse($laporan->waktu_pelaporan)->format('H:i') }} WIB
                                    </small>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="card border-0 shadow-sm mb-4">
                                    <div class="card-header bg-light">
                                        <h5 class="mb-0 fw-bold"><i class="fas fa-info-circle me-2"></i>Detail Fasilitas
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <h6 class="fw-bold">Fasilitas Dilaporkan</h6>
                                            <p class="fs-5">{{ $laporan->fasilitas->nama }}</p>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <h6 class="fw-bold">Lokasi Ruangan</h6>
                                                <p>{{ $laporan->fasilitas->ruangan->nama }}</p>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <h6 class="fw-bold">Gedung</h6>
                                                <p>{{ $laporan->fasilitas->ruangan->gedung->nama }}</p>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <h6 class="fw-bold">Kategori Fasilitas</h6>
                                            <span
                                                class="badge bg-primary fs-6">{{ $laporan->fasilitas->kategori->nama }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card border-0 shadow-sm mb-4">
                                    <div class="card-header bg-light">
                                        <h5 class="mb-0 fw-bold"><i class="fas fa-file-alt me-2"></i>Deskripsi Laporan</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <h6 class="fw-bold">Status</h6>
                                            @php
                                                $statusColors = [
                                                    'BARU' => 'bg-primary',
                                                    'DIPROSES' => 'bg-warning text-dark',
                                                    'SELESAI' => 'bg-success',
                                                    'DITOLAK' => 'bg-danger',
                                                ];
                                            @endphp
                                            <span
                                                class="badge {{ $statusColors[$laporan->status] ?? 'bg-secondary' }} fs-6">
                                                {{ $laporan->status }}
                                            </span>
                                        </div>

                                        <div class="mb-3">
                                            <h6 class="fw-bold">Deskripsi Masalah</h6>
                                            <div class="p-3 bg-light rounded">
                                                {!! nl2br(e($laporan->deskripsi)) !!}
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <h6 class="fw-bold">Foto Pendukung</h6>
                                            <img src="{{ asset('storage/laporan/' . $laporan->url_foto) }}"
                                                alt="Foto Laporan" class="img-fluid rounded border"
                                                style="max-height: 200px; cursor: pointer" data-bs-toggle="modal"
                                                data-bs-target="#imageModal">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card border-0 shadow-sm mt-4">
                            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                <h5 class="mb-0 fw-bold">
                                    <i class="fas fa-users me-2"></i>Pendukung Laporan
                                    <span class="badge bg-primary ms-2">{{ $laporan->pendukung->count() }} Orang</span>
                                </h5>

                                <div class="d-flex gap-2">
                                    <button type="button" class="btn btn-sm btn-primary"
                                        onclick="modalAction('{{ url('/pelaporan/' . $laporan->id_laporan . '/pendukung/create') }}')">
                                        <i class="fas fa-plus me-1"></i> Tambah Pendukung
                                    </button>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0" id="supportersTable">
                                        <thead class="table-light">
                                            <tr>
                                                <th width="5%">#</th>
                                                <th>Nama Pendukung</th>
                                                <th>Email</th>
                                                <th>Waktu Dukungan</th>
                                                <th>Tingkat Kerusakan</th>
                                                <th width="15%">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($laporan->pendukung as $index => $pendukung)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-shrink-0">
                                                                <img src="{{ asset('template/assets/images/users/avatar-1.jpg') }}"
                                                                    alt="User " class="rounded-circle" width="32"
                                                                    height="32">
                                                            </div>
                                                            <div class="flex-grow-1 ms-2">
                                                                {{ $pendukung->pengguna->profil->nama_lengkap }}
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>{{ $pendukung->pengguna->surel }}</td>
                                                    <td>
                                                        {{ \Carbon\Carbon::parse($pendukung->created_at)->translatedFormat('j M Y, H:i') }}
                                                    </td>
                                                    <td>
                                                        @php
                                                            $damageLevels = [
                                                                1 => ['Ringan', 'success'],
                                                                2 => ['Sedang', 'warning'],
                                                                3 => ['Berat', 'danger'],
                                                            ];
                                                        @endphp
                                                        <span
                                                            class="badge bg-{{ $damageLevels[$pendukung->tingkat_kerusakan][1] }}">
                                                            {{ $damageLevels[$pendukung->tingkat_kerusakan][0] }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-sm btn-outline-primary"
                                                            data-bs-toggle="modal" data-bs-target="#supporterDetailModal"
                                                            data-desc="{{ $pendukung->deskripsi }}">
                                                            <i class="fas fa-eye"></i> Detail
                                                        </button>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6" class="text-center py-4 text-muted">
                                                        Belum ada pendukung untuk laporan ini
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Kembali
                            </a>
                            <div>
                                <a href="javascript:window.print()" class="btn btn-outline-primary me-2">
                                    <i class="fas fa-print me-2"></i>Cetak
                                </a>
                                @if ($laporan->status == 'BARU')
                                    <button class="btn btn-success">
                                        <i class="fas fa-check-circle me-2"></i>Proses Laporan
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Foto Laporan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img src="{{ asset('storage/laporan/' . $laporan->url_foto) }}" alt="Foto Laporan"
                        class="img-fluid">
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="supporterDetailModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Deskripsi Pendukung</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="p-3 bg-light rounded">
                        <p id="supporterDescription">{{ $laporan->deskripsi }}</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <div id="myModal" class="modal fade" tabindex="-1">
    </div>
@endsection

<script>
    function modalAction(url = '') {
        $('#myModal').load(url, function() {
            $('#myModal').modal('show');
        });
    }
</script>

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#supportersTable').DataTable({
                responsive: true,
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json'
                }
            });

            $('#supporterDetailModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var description = button.data('desc');
                $(this).find('#supporterDescription').text(description);
            });

            $('[data-bs-toggle="tooltip"]').tooltip();
        });
    </script>
@endsection

<style>
    .card-header {
        border-radius: 0.5rem 0.5rem 0 0 !important;
    }

    .table th {
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
    }

    .badge {
        font-weight: 500;
        padding: 0.35em 0.65em;
    }

    .img-thumbnail {
        transition: transform 0.2s;
    }

    .img-thumbnail:hover {
        transform: scale(1.05);
        cursor: zoom-in;
    }

    @media print {
        .card {
            padding: 20px
        }

        .d-print-none {
            display: none !important;
        }

        nav,
        footer,
        .card-header,
        .btn,
        .breadcrumb {
            display: none !important;
        }

        .print-header {
            display: block !important;
        }

        body {
            margin: 1cm;
            font-size: 12pt;
        }

        .print-header {
            display: block !important;
            text-align: center;
            margin-bottom: 2rem;
        }

        .print-header h3,
        .print-header p {
            margin: 0;
        }
    }
    
    .print-header {
        display: none;
    }
</style>
