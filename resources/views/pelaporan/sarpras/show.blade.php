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

                <div class="card border-0 shadow-sm">
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
                                    <div class="card-header bg-primary">
                                        <h5 class="mb-0 fw-bold text-white">
                                            <i class="fas fa-info-circle me-2"></i> Detail Fasilitas
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="report-details">
                                            <div
                                                class="d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom">
                                                <h4 class="h5 mb-0 fw-semibold text-dark">Detail Laporan</h4>
                                                <span
                                                    class="badge bg-{{ $laporan->status->color() }} bg-opacity-15 text-white border border-{{ $laporan->status->color() }} border-opacity-25">
                                                    {{ $laporan->status }}
                                                </span>
                                            </div>

                                            <div class="vstack gap-3 mb-4">
                                                <!-- Info Fasilitas -->
                                                <div class="d-flex align-items-start">
                                                    <div class="bg-info bg-opacity-10 p-2 rounded-2 me-3">
                                                        <i class="fas fa-info-circle text-info"></i>
                                                    </div>
                                                    <div>
                                                        <h5 class="h6 text-secondary mb-1">Fasilitas Dilaporkan</h5>
                                                        <p class="mb-0 fw-medium">{{ $laporan->fasilitas->nama }}</p>
                                                        <div class="mt-2">
                                                            <span
                                                                class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-1">
                                                                {{ $laporan->fasilitas->kategori->nama }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Info Lokasi -->
                                                <div class="d-flex align-items-start">
                                                    <div class="bg-info bg-opacity-10 p-2 rounded-2 me-3">
                                                        <i class="fas fa-map-marker-alt text-info"></i>
                                                    </div>
                                                    <div>
                                                        <h5 class="h6 text-secondary mb-1">Lokasi</h5>
                                                        <div class="d-flex flex-wrap gap-3">
                                                            <div>
                                                                <p class="mb-1 small text-muted">Ruangan</p>
                                                                <p class="mb-0 fw-medium">
                                                                    {{ $laporan->fasilitas->ruangan->nama }}</p>
                                                            </div>
                                                            <div>
                                                                <p class="mb-1 small text-muted">Gedung</p>
                                                                <p class="mb-0 fw-medium">
                                                                    {{ $laporan->fasilitas->ruangan->gedung->nama }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Kolom Kanan: Deskripsi Laporan -->
                            <div class="col-md-6">
                                <div class="card border-0 shadow-sm mb-4">
                                    <div class="card-header bg-primary">
                                        <h5 class="mb-0 fw-bold text-white">
                                            <i class="fas fa-file-alt me-2"></i> Deskripsi Laporan
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <!-- Status -->
                                        <div class="mb-3">
                                            <h6 class="fw-bold">Status</h6>
                                            <span
                                                class="badge bg-{{ $laporan->status->color() }} bg-opacity-15 text-white border border-{{ $laporan->status->color() }} border-opacity-25">
                                                {{ $laporan->status }}
                                            </span>
                                        </div>

                                        <!-- Deskripsi Masalah -->
                                        <div class="d-flex align-items-start mb-3">
                                            <div class="bg-info bg-opacity-10 p-2 rounded-2 me-3">
                                                <i class="fas fa-exclamation-triangle text-info"></i>
                                            </div>
                                            <div>
                                                <h5 class="h6 text-secondary mb-1">Deskripsi Masalah</h5>
                                                <div class="p-3 bg-light bg-opacity-10 rounded-2">
                                                    {!! nl2br(e($laporan->deskripsi)) !!}
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Foto Pendukung -->
                                        <div class="d-flex align-items-start">
                                            <div class="bg-info bg-opacity-10 p-2 rounded-2 me-3">
                                                <i class="fas fa-image text-info"></i>
                                            </div>
                                            <div>
                                                <h5 class="h6 text-secondary mb-1">Foto Pendukung</h5>
                                                <button type="button" class="btn btn-sm btn-outline-primary"
                                                    data-bs-toggle="modal" data-bs-target="#imageModal">
                                                    <i class="fas fa-eye me-1"></i> Lihat Gambar
                                                </button>
                                            </div>
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
                                @if (Auth::user()->isSarpras())
                                    <button type="button" class="btn btn-primary"
                                        onclick="modalAction('{{ url('/pelaporan/' . $laporan->id_laporan . '/pendukung/create') }}')">
                                        <i class="fas fa-plus me-1"></i> Tambah Pendukung
                                    </button>
                                @endif
                            </div>

                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle mb-0" id="supportersTable">
                                        <thead class="table-light">
                                            <tr>
                                                <th width="5%">#</th>
                                                <th>Nama Pendukung</th>
                                                <th>Email</th>
                                                <th>Waktu Dukungan</th>
                                                <th>Tingkat Kerusakan</th>
                                                @if (Auth::user()->isSarpras())
                                                    <th width="15%">Aksi</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($laporan->pendukung as $index => $pendukung)
                                                @php
                                                    $user = $pendukung->pengguna;
                                                    $profile = $user->profil;
                                                    $avatar = asset('storage/foto_profil/' . $profile->foto_profil);
                                                    $nama = $profile->nama_lengkap ?? 'Nama Tidak Diketahui';
                                                    $email = $user->surel ?? '-';
                                                    $createdAt = \Carbon\Carbon::parse(
                                                        $pendukung->created_at,
                                                    )->translatedFormat('j M Y');
                                                    $damageLevels = [
                                                        1 => ['Ringan', 'success'],
                                                        2 => ['Sedang', 'warning'],
                                                        3 => ['Berat', 'danger'],
                                                    ];
                                                @endphp
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <img src="{{ $avatar }}" alt="User"
                                                                class="rounded-circle me-2" width="32"
                                                                height="32">
                                                            <span>{{ $nama }}</span>
                                                        </div>
                                                    </td>
                                                    <td>{{ $email }}</td>
                                                    <td>{{ $createdAt }}</td>
                                                    <td>
                                                        <span
                                                            class="badge bg-{{ $damageLevels[$pendukung->tingkat_kerusakan->value][1] }}">
                                                            {{ $damageLevels[$pendukung->tingkat_kerusakan->value][0] }}
                                                        </span>
                                                    </td>
                                                    @if (Auth::user()->isSarpras())
                                                        <td>
                                                            <button type="button" class="btn btn-sm btn-outline-danger"
                                                                onclick="modalConfirm({{ $pendukung->id_user }}, {{ $laporan->id_laporan }})">
                                                                <i class="bx bx-trash me-1"></i> Hapus
                                                            </button>
                                                        </td>
                                                    @endif
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6" class="text-center py-4 text-muted">
                                                        <i class="fas fa-info-circle me-1"></i> Belum ada pendukung untuk
                                                        laporan ini.
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
                                @if (Auth::user()->isAdmin())
                                    <button onclick="showConfirmModal({{ $laporan->id_laporan }})" class="btn btn-outline-success me-2">
                                        <i class="fas fa-check-circle me-2"></i>Verifikasi
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
                    <img src="{{ asset('storage/uploads/laporan/' . $laporan->url_foto) }}" alt="Foto Laporan"
                        class="img-fluid" width="80%">
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Verifikasi -->
    <div class="modal fade" id="verifikasiModal" tabindex="-1" aria-labelledby="ajukanModalLabel" aria-hidden="true">
        @include('pelaporan.admin.component.modal_verifikasi');
    </div>

    <div id="myModal" class="modal fade" tabindex="-1">
    </div>

    @include('pelaporan.sarpras.modal_pendukung_confirm')
@endsection

<script>
    function showConfirmModal(id) {
        currentLaporanId = id;
        $('#verifikasiModal').modal('show');
    }

    function modalConfirm(pendukungId, laporanId) {
        $('#confirmModalDelete').modal('show');
        $('#form-delete').attr('action', '/pelaporan/' + laporanId + '/pendukung/' + pendukungId + '/delete');

        $('#modal-delete-title').html('Konfirmasi Penghapusan Pendukung');
        $('#modal-delete-body').html(`
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-triangle me-2"></i>
            Anda akan menghapus data pendukung laporan ini. Data yang dihapus tidak dapat dikembalikan.
        </div>
    `);

        $('#form-delete').off('submit');

        $('#form-delete').on('submit', function(e) {
            e.preventDefault();

            const form = this;
            const formData = new FormData(form);
            const submitBtn = $('#delete-submit-btn');
            const originalBtnText = submitBtn.html();

            $.ajax({
                url: form.action,
                type: 'DELETE',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Accept': 'application/json'
                },
                success: function(response) {
                    $('#confirmModalDelete').modal('hide');

                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: response.message || 'Data pendukung berhasil dihapus',
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        // Refresh data without full page reload if possible
                        if (typeof dataPelaporan !== 'undefined' && dataPelaporan.ajax) {
                            dataPelaporan.ajax.reload(null, false);
                        } else {
                            location.reload();
                        }
                    });
                },
                error: function(xhr) {
                    let errorMessage = 'Terjadi kesalahan saat menghapus pendukung.';

                    if (xhr.status === 422) {
                        errorMessage = xhr.responseJSON.message || 'Validasi gagal.';
                    } else if (xhr.status === 404) {
                        errorMessage = 'Data tidak ditemukan.';
                    } else if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    }

                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: errorMessage
                    });
                },
            });
        });
    }

    function modalAction(url = '') {
        $('#myModal').load(url, function() {
            $('#myModal').modal('show');
        });
    }
</script>

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
