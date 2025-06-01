@extends('layout.app')

@section('content')
    <div class="">
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-clipboard-list fa-lg me-3"></i>
                            <h2 class="mb-0 h5 fw-semibold">Detail Fasilitas</h2>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="image">
                            @if ($fasilitas->gambar)
                                <div class="ratio ratio-1x1 rounded-3 overflow-hidden bg-light mb-3 border">
                                    <img src="{{ asset('storage/uploads/fasilitas/' . $fasilitas->gambar) }}"
                                        class="img-fluid object-fit-cover hover-zoom" alt="Foto Fasilitas"
                                        style="transition: transform 0.3s ease;">
                                </div>
                            @else
                                <div
                                    class="ratio ratio-1x1 bg-light rounded-3 border d-flex flex-column align-items-center justify-content-center mb-3">
                                    <i class="fas fa-image fa-3x text-secondary mb-2 opacity-75"></i>
                                    <span class="text-secondary">Tidak ada gambar</span>
                                </div>
                            @endif
                        </div>
                        <div class="deskripsi-fasilitas">
                            <h3 class="h4 mb-3 text-primary fw-bold">{{ $fasilitas->nama }}</h3>

                            <div class="vstack gap-3">
                                <!-- Location -->
                                <div class="d-flex align-items-start">
                                    <div class="bg-primary bg-opacity-10 p-2 rounded-2 me-3">
                                        <i class="fas fa-map-marker-alt text-primary"></i>
                                    </div>
                                    <div>
                                        <h5 class="h6 text-secondary mb-1">Lokasi</h5>
                                        <p class="mb-0 fw-medium">
                                            {{ $fasilitas->ruangan->gedung->nama . ', ' . $fasilitas->ruangan->nama }}</p>
                                    </div>
                                </div>

                                <!-- Description -->
                                <div class="d-flex align-items-start">
                                    <div class="bg-primary bg-opacity-10 p-2 rounded-2 me-3">
                                        <i class="fas fa-align-left text-primary"></i>
                                    </div>
                                    <div>
                                        <h5 class="h6 text-secondary mb-1">Kategori Fasilitas</h5>
                                        <p class="mb-0 fw-medium">{{ $fasilitas->kategori->nama }}</p>
                                    </div>
                                </div>

                                <!-- Status -->
                                <div class="d-flex align-items-start">
                                    <div class="bg-primary bg-opacity-10 p-2 rounded-2 me-3">
                                        <i class="fas fa-info-circle text-primary"></i>
                                    </div>
                                    <div>
                                        <h5 class="h6 text-secondary mb-1">Status</h5>
                                        <span
                                            class="badge rounded-pill bg-{{ $fasilitas->status === 'tersedia' ? 'success' : 'warning' }} px-3 py-2">
                                            {{ ucfirst($fasilitas->status) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-clipboard-list fa-lg me-3"></i>
                            <h2 class="mb-0 h5 fw-semibold">Laporan Kerusakan</h2>
                        </div>
                    </div>
                    <div class="card-body">
                        @if ($fasilitas->laporan)
                            <div
                                class="alert alert-info bg-info bg-opacity-10 border border-info border-opacity-25 d-flex align-items-start">
                                <i class="fas fa-info-circle fa-lg mt-1 me-3 text-info"></i>
                                <div>
                                    <h4 class="alert-heading h5 mb-2 fw-semibold">Laporan Aktif</h4>
                                    <p class="mb-0">Fasilitas ini sudah memiliki laporan kerusakan. Anda dapat mendukung
                                        laporan
                                        ini jika mengalami masalah yang sama.</p>
                                </div>
                            </div>

                            <div class="report-details">
                                <div class="d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom">
                                    <h4 class="h5 mb-0 fw-semibold text-dark">Detail Laporan</h4>
                                    <span
                                        class="badge bg-{{ $fasilitas->laporan->status === 'diproses' ? 'warning' : 'primary' }} rounded-pill px-3 py-2 fw-normal">
                                        {{ ucfirst($fasilitas->laporan->status) }}
                                    </span>
                                </div>

                                <div class="vstack gap-3 mb-4">
                                    <!-- Damage Description -->
                                    <div class="d-flex align-items-start">
                                        <div class="bg-info bg-opacity-10 p-2 rounded-2 me-3">
                                            <i class="fas fa-exclamation-triangle text-info"></i>
                                        </div>
                                        <div>
                                            <h5 class="h6 text-secondary mb-1">Deskripsi Kerusakan</h5>
                                            <p class="mb-0">{{ $fasilitas->laporan->deskripsi }}</p>
                                        </div>
                                    </div>

                                    <!-- Reporter -->
                                    <div class="d-flex align-items-start">
                                        <div class="bg-info bg-opacity-10 p-2 rounded-2 me-3">
                                            <i class="fas fa-user text-info"></i>
                                        </div>
                                        <div>
                                            <h5 class="h6 text-secondary mb-1">Pelapor</h5>
                                            <p class="mb-0 fw-medium">{{ $fasilitas->laporan->pengguna->nama_pengguna }}</p>
                                        </div>
                                    </div>

                                    <!-- Report Date -->
                                    <div class="d-flex align-items-start">
                                        <div class="bg-info bg-opacity-10 p-2 rounded-2 me-3">
                                            <i class="fas fa-calendar-alt text-info"></i>
                                        </div>
                                        <div>
                                            <h5 class="h6 text-secondary mb-1">Tanggal Laporan</h5>
                                            <p class="mb-0">
                                                {{ \Carbon\Carbon::parse($fasilitas->laporan->created_at)->translatedFormat('d F Y') }}
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Supporters -->
                                    <div class="d-flex align-items-start">
                                        <div class="bg-info bg-opacity-10 p-2 rounded-2 me-3">
                                            <i class="fas fa-users text-info"></i>
                                        </div>
                                        <div>
                                            <h5 class="h6 text-secondary mb-1">Pendukung
                                                ({{ $fasilitas->laporan->pendukung->count() }})</h5>
                                            @if ($fasilitas->laporan->pendukung->count() > 0)
                                                <div class="d-flex flex-wrap gap-2 mt-2">
                                                    @foreach ($fasilitas->laporan->pendukung->take(5) as $pendukung)
                                                        <span
                                                            class="badge bg-secondary bg-opacity-10 text-dark rounded-pill px-3 py-1 border border-secondary border-opacity-10">
                                                            {{ $pendukung->pengguna->profil->nama_lengkap }}
                                                        </span>
                                                    @endforeach
                                                    @if ($fasilitas->laporan->pendukung_count > 5)
                                                        <span class="badge bg-light text-dark rounded-pill px-3 py-1">
                                                            +{{ $fasilitas->laporan->pendukung->count() - 5 }} lainnya
                                                        </span>
                                                    @endif
                                                </div>
                                            @else
                                                <p class="mb-0 text-muted">Belum ada pendukung</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Support/Cancel Support Buttons -->
                                <div class="text-center mt-4">
                                    @if (!$fasilitas->laporan->telahDidukung())
                                        <button
                                            class="btn btn-success rounded-pill px-4 py-2 fw-medium shadow-sm hover-scale"
                                            onclick="modalAction('{{ url('pelaporan/' . $fasilitas->id_fasilitas . '/pendukung/dukungan/create') }}')">
                                            <i class="fas fa-thumbs-up me-2"></i>Dukung Laporan Ini
                                        </button>
                                        <p class="text-muted small mt-2">Dukung laporan ini untuk mempercepat proses
                                            perbaikan</p>
                                    @else
                                        <div class="d-flex justify-content-center gap-3">
                                            <div
                                                class="d-inline-flex align-items-center bg-success bg-opacity-10 rounded-pill px-4 py-2 border border-success border-opacity-25">
                                                <i class="fas fa-check-circle text-success me-2"></i>
                                                <span class="fw-medium">Anda sudah mendukung</span>
                                            </div>
                                            @if (auth()->id() == $fasilitas->laporan->id_pengguna)
                                                <button
                                                    class="btn btn-outline-danger rounded-pill px-4 py-2 fw-medium hover-scale"
                                                    onclick="modalAction('{{ url('/pelaporan/' . $fasilitas->laporan->id_laporan . '/confirm') }}')">
                                                    <i class="fas fa-trash me-2"></i>Hapus Laporan
                                                </button>
                                            @else
                                                <button
                                                    class="btn btn-outline-danger rounded-pill px-4 py-2 fw-medium hover-scale"
                                                    onclick="confirmCancelSupport('{{ url('/pelaporan/' . $fasilitas->laporan->id_laporan . '/pendukung/' . Auth::user()->id_pengguna . '/delete') }}')">
                                                    <i class="fas fa-times me-2"></i>Batalkan Dukungan
                                                </button>
                                            @endif
                                        </div>
                                        <p class="small mt-2 text-success">
                                            @if (auth()->id() == $fasilitas->laporan->id_pengguna)
                                                Anda adalah pembuat laporan ini. Anda dapat menghapus laporan jika
                                                diperlukan.
                                            @else
                                                {{ $fasilitas->laporan->telahDidukung() ? 'Terima kasih telah berkontribusi!' : 'Dukung laporan ini untuk mempercepat proses perbaikan' }}
                                            @endif
                                        </p>
                                    @endif
                                </div>
                            </div>
                        @else
                            <!-- No Report - Create New -->
                            <div
                                class="alert alert-warning bg-warning bg-opacity-10 border border-warning border-opacity-25 d-flex align-items-start">
                                <i class="fas fa-exclamation-triangle fa-lg mt-1 me-3 text-warning"></i>
                                <div>
                                    <h4 class="alert-heading h5 mb-2 fw-semibold">Tidak Ada Laporan</h4>
                                    <p class="mb-0">Fasilitas ini belum memiliki laporan kerusakan. Anda dapat membuat
                                        laporan
                                        jika menemukan kerusakan.</p>
                                </div>
                            </div>

                            <div class="text-center">
                                <button class="btn btn-primary rounded-pill px-4 py-2 fw-medium shadow-sm hover-scale"
                                    onclick="modalAction('{{ url('pelaporan/' . $fasilitas->id_fasilitas . '/create') }}')">
                                    <i class="fas fa-plus-circle me-2"></i>Buat Laporan Kerusakan
                                </button>
                            </div>
                        @endif

                        <div class="mt-4 text-center">
                            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary hover-scale">
                                <i class="fas fa-arrow-left me-2"></i>Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="myModal" class="modal fade" tabindex="-1"></div>
    <!-- Modal -->
    @if ($fasilitas->laporan)
        <div id="myModal" class="modal fade" tabindex="-1"></div>
    @else
        <div id="myModal" class="modal fade" tabindex="-1"></div>
    @endif
@endsection

@push('css')
    <style>
        .hover-zoom:hover {
            transform: scale(1.03);
        }
    </style>
    <style>
        .hover-scale {
            transition: transform 0.2s ease;
        }

        .hover-scale:hover {
            transform: scale(1.03);
        }
    </style>
@endpush

@push('scripts')
    <script>
        function confirmCancelSupport(url) {
            Swal.fire({
                title: 'Batalkan Dukungan?',
                text: "Anda yakin ingin membatalkan dukungan untuk laporan ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Batalkan!',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'DELETE',
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
                                timer: 1000,
                                showConfirmButton: false
                            }).then(() => {
                                window.location.reload();
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
                }
            });
        }
    </script>
    <script>
        function modalAction(url = '') {
            $('#myModal').load(url, function() {
                $('#myModal').modal('show');
            });
        }
    </script>
@endpush
