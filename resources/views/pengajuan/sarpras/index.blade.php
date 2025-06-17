@extends('layout.app')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="h4 mb-0">Pengajuan Laporan Perbaikan</h2>
                </div>

                <div class="row g-4 mb-4">
                    <div class="col-xl-3 col-md-6">
                        <div class="card card-stats h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <span class="text-muted mb-1 d-block text-truncate">Jumlah Rekomendasi</span>
                                        <h3 class="mb-0">
                                            <span class="counter-value" data-target="{{ $rekomendasi->count() }}">0</span>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6">
                        <div class="card card-stats h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <span class="text-muted mb-1 d-block text-truncate">Jumlah Laporan Aktif</span>
                                        <h3 class="mb-0">
                                            <span class="counter-value"
                                                data-target="{{ $laporan->where('status.value', '!=', 'selesai')->count() }}">0</span>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6">
                        <div class="card card-stats h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <span class="text-muted mb-1 d-block text-truncate">Jumlah Laporan Diproses</span>
                                        <h3 class="mb-0">
                                            <span class="counter-value"
                                                data-target="{{ $laporan->where('status.value', 'diperbaiki')->count() }}">0</span>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6">
                        <div class="card card-stats h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <span class="text-muted mb-1 d-block text-truncate">Jumlah Laporan Selesai</span>
                                        <h3 class="mb-0">
                                            <span class="counter-value"
                                                data-target="{{ $laporan->where('status.value', 'selesai')->count() }}">0</span>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="row g-4 mb-4">
                        </div>

                        <div class="card mb-4">
                            <div class="card-header bg-secondary text-white">
                                <h5 class="mb-0 text-white">Daftar Laporan yang Diajukan
                                </h5>
                            </div>
                            <div class="card-body">
                                @if ($laporanDiajukan->isEmpty())
                                    <div class="empty-state text-center py-4">
                                        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                        <h4 class="h5">Belum ada laporan yang diajukan</h4>
                                        <p class="text-muted">Ajukan laporan perbaikan untuk melihatnya di sini</p>
                                    </div>
                                @else
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th width="5%">#</th>
                                                    <th width="25%">Nama Fasilitas</th>
                                                    <th width="20%">Tanggal Pengajuan</th>
                                                    <th width="15%">Status</th>
                                                    <th width="15%">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($laporanDiajukan as $item)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $item->fasilitas->nama }}</td>
                                                        <td>{{ $item->waktu_perubahan }}</td>
                                                        <td>
                                                            <span class="badge bg-{{ $item->status->color() }}">
                                                                {{ $item->status->label() }}
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <a href="" class="btn btn-sm btn-outline-primary">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Rekomendasi Sectionn -->
                    <div class="col-lg-6 mb-4">
                        <div class="card h-100">
                            <div
                                class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                                <h5 class="mb-0 text-white">
                                    <i class="fas fa-lightbulb me-2"></i>Rekomendasi Perbaikan
                                </h5>
                                <span class="badge bg-white text-primary">{{ $rekomendasi->count() }}</span>
                            </div>
                            <div class="card-body">
                                @if ($rekomendasi->isEmpty())
                                    <div class="empty-state text-center py-5">
                                        <i class="fas fa-lightbulb fa-3x text-muted mb-3"></i>
                                        <h4 class="h5">Tidak ada rekomendasi saat ini</h4>
                                        <p class="text-muted">Sistem akan memberikan rekomendasi perbaikan berdasarkan
                                            analisis laporan</p>
                                        <button class="btn btn-primary mt-3" onclick="location.reload()">
                                            <i class="fas fa-sync-alt me-2"></i>Muat Ulang
                                        </button>
                                    </div>
                                @else
                                    <div class="list-group list-group-flush">
                                        @foreach ($rekomendasi as $item)
                                            <div class="list-group-item p-0">
                                                @include('pengajuan.component.rekomendasi_laporan_item', [
                                                    'item' => $item,
                                                ])
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Laporan Section -->
                    <div class="col-lg-6 mb-4">
                        <div class="card h-100">
                            <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                                <h5 class="mb-0 text-white">
                                    <i class="fas fa-tasks me-2"></i>Daftar Laporan Terkini
                                </h5>
                                <span
                                    class="badge bg-white text-info">{{ $laporan->where('status.value', '=', 'baru')->count() }}</span>
                            </div>
                            <div class="card-body">
                                @if ($laporan->isEmpty())
                                    <div class="empty-state text-center py-5">
                                        <i class="fas fa-clipboard-list fa-3x text-muted mb-3"></i>
                                        <h4 class="h5">Tidak ada laporan ditemukan</h4>
                                        <p class="text-muted">Coba ubah filter pencarian atau buat laporan baru</p>
                                    </div>
                                @else
                                    <div class="list-group list-group-flush">
                                        @if ($laporan->where('status.value', 'baru')->take(5)->isEmpty())
                                            <div class="empty-state text-center py-5">
                                                <i class="fas fa-clipboard-list fa-3x text-muted mb-3"></i>
                                                <h4 class="h5">Tidak ada laporan ditemukan</h4>
                                                <p class="text-muted">Coba ubah filter pencarian atau buat laporan baru
                                                </p>
                                            </div>
                                        @else
                                            @foreach ($laporan->where('status.value', 'baru')->take(5) as $item)
                                                <div class="list-group-item p-0">
                                                    @include(
                                                        'pengajuan.component.rekomendasi_laporan_item',
                                                        ['item' => $item]
                                                    )
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="myModal" class="modal fade" tabindex="-1">
    </div>
@endsection

@push('styles')
    <style>
        .card-stats {
            border-radius: 0.5rem;
            transition: all 0.3s ease;
            border: none;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }

        .card-stats:hover {
            transform: translateY(-5px);
            box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.1);
        }

        .icon-shape {
            width: 3rem;
            height: 3rem;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 0.5rem;
        }

        .report-card {
            transition: all 0.3s ease;
            border-radius: 0.5rem;
            overflow: hidden;
            margin-bottom: 1rem;
        }

        .report-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .status-badge {
            font-size: 0.75rem;
            padding: 0.35em 0.65em;
        }

        .empty-state {
            max-width: 500px;
            margin: 0 auto;
        }

        .progress-thin {
            height: 6px;
        }

        .list-group-item {
            border-left: none;
            border-right: none;
            padding: 1rem;
        }

        .list-group-item:first-child {
            border-top: none;
        }

        .card-header {
            border-radius: 0.5rem 0.5rem 0 0 !important;
            padding: 1rem 1.5rem;
        }

        .counter-value {
            font-weight: 600;
        }
    </style>
@endpush

@push('scripts')
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const counters = document.querySelectorAll('.counter-value');
            const speed = 200;

            counters.forEach(counter => {
                const target = +counter.getAttribute('data-target');
                const count = +counter.innerText;
                const increment = target / speed;

                if (count < target) {
                    counter.innerText = Math.ceil(count + increment);
                    setTimeout(updateCounter, 1);
                } else {
                    counter.innerText = target;
                }

                function updateCounter() {
                    const count = +counter.innerText;
                    if (count < target) {
                        counter.innerText = Math.ceil(count + increment);
                        setTimeout(updateCounter, 1);
                    } else {
                        counter.innerText = target;
                    }
                }
            });

            document.getElementById('filterForm').addEventListener('submit', function(e) {
                e.preventDefault();
                this.submit();
            });

        });
    </script>
@endpush
