@extends('layout.app')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-lg">
                    <div class="card-header bg-gradient-primary text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <h2 class="h5 mb-0">
                                <i class="fas fa-tasks me-2"></i>Pelacakan Laporan Fasilitas
                            </h2>
                            <div class="badge bg-white bg-opacity-20 text-white">
                                <i class="fas fa-sync-alt me-1"></i> Pembaruan Real-time
                            </div>
                        </div>

                        <ul class="nav nav-tabs nav-tabs-white mt-3" id="laporanTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="laporan-saya-tab" data-bs-toggle="tab"
                                    data-bs-target="#laporan-saya" type="button" role="tab"
                                    aria-controls="laporan-saya" aria-selected="true">
                                    <i class="fas fa-clipboard-check me-2"></i>Laporan Saya
                                    <span class="badge bg-white text-primary ms-2">{{ count($laporanSaya) }}</span>
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pendukung-tab" data-bs-toggle="tab" data-bs-target="#pendukung"
                                    type="button" role="tab" aria-controls="pendukung" aria-selected="false">
                                    <i class="fas fa-hands-helping me-2"></i>Laporan Didukung
                                    <span class="badge bg-white text-success ms-2">{{ count($laporanDidukung) }}</span>
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="selesai-tab" data-bs-toggle="tab" data-bs-target="#selesai"
                                    type="button" role="tab" aria-controls="selesai" aria-selected="true">
                                    <i class="fas fa-clipboard-check me-2"></i>Laporan Selesai
                                    <span class="badge bg-white text-primary ms-2">{{ count($laporanSelesai) }}</span>
                                </button>
                            </li>
                        </ul>
                    </div>

                    <div class="card-body pt-4 px-4">
                        <div class="tab-content" id="laporanTabContent">
                            <div class="tab-pane fade show active" id="laporan-saya" role="tabpanel"
                                aria-labelledby="laporan-saya-tab">
                                @if (count($laporanSaya) > 0)
                                    <div class="row g-4">
                                        @foreach ($laporanSaya as $laporan)
                                            <div class="col-lg-6">
                                                <div class="card h-100 border-0 shadow-sm-hover">
                                                    <div
                                                        class="card-header d-flex justify-content-between align-items-center bg-light-primary bg-opacity-10">
                                                        <div class="d-flex flex-wrap gap-2">
                                                            <span
                                                                class="badge bg-{{ $laporan->status->color() }} bg-opacity-15 text-white border border-{{ $laporan->status->color() }} border-opacity-25">
                                                                {{ $laporan->status }}
                                                            </span>
                                                            <span class="badge bg-info bg-opacity-10 text-info">
                                                                <i class="fas fa-calendar-alt me-1"></i>
                                                                {{ \Carbon\Carbon::parse($laporan->waktu_pelaporan)->locale('id')->diffForHumans() }}
                                                            </span>
                                                        </div>
                                                        <div class="dropdown">
                                                            <button class="btn btn-sm btn-link text-muted" type="button"
                                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                                <i class="fas fa-ellipsis-v"></i>
                                                            </button>
                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                <li>
                                                                    <a class="dropdown-item"
                                                                        href="{{ url('pelaporan/fasilitas/' . $laporan->id_fasilitas . '/show') }}">
                                                                        <i class="fas fa-eye me-2"></i>Lihat Detail
                                                                    </a>
                                                                </li>
                                                                @if ($laporan->status->value === 'baru' || $laporan->status->value === 'diproses')
                                                                    <li>
                                                                        <button class="dropdown-item"
                                                                            onclick="modalAction('{{ url('/tracking/' . $laporan->id_laporan . '/laporan/edit') }}')">
                                                                            <i class="fas fa-edit me-2"></i>Edit Laporan
                                                                        </button>
                                                                    </li>
                                                                @endif
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <h5 class="card-title text-primary mb-2">
                                                            <i
                                                                class="fas fa-building me-2"></i>{{ $laporan->fasilitas->nama }}
                                                        </h5>
                                                        <p class="card-text text-muted mb-3">
                                                            <i class="fas fa-quote-left me-1 text-muted opacity-50"></i>
                                                            {{ Str::limit($laporan->deskripsi, 120) }}
                                                        </p>

                                                        <div class="d-flex align-items-center mb-3">
                                                            <div class="flex-grow-1 me-3">
                                                                <div class="progress" style="height: 6px;">
                                                                    <div class="progress-bar bg-{{ $laporan->status_color }}"
                                                                        role="progressbar"
                                                                        style="width: {{ $laporan->progress }}%"
                                                                        aria-valuenow="{{ $laporan->progress }}"
                                                                        aria-valuemin="0" aria-valuemax="100"></div>
                                                                </div>
                                                            </div>
                                                            <small
                                                                class="text-{{ $laporan->status_color }} fw-semibold">{{ $laporan->progress }}%</small>
                                                        </div>

                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div class="d-flex align-items-center">
                                                                <div class="avatar-group me-2">
                                                                    @forelse($laporan->pendukung->take(3) as $pendukung)
                                                                        <img src="{{ $pendukung->avatar }}"
                                                                            class="avatar avatar-xs rounded-circle border border-white"
                                                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                                                            title="{{ $pendukung->name }}">
                                                                    @empty
                                                                        <span
                                                                            class="avatar avatar-xs rounded-circle bg-light text-muted">
                                                                            <i class="fas fa-users"></i>
                                                                        </span>
                                                                    @endforelse
                                                                    @if ($laporan->pendukung_count > 3)
                                                                        <div
                                                                            class="avatar avatar-xs rounded-circle bg-light text-dark border border-white">
                                                                            +{{ $laporan->pendukung_count - 3 }}
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                                <span class="badge bg-light text-dark">
                                                                    <i class="fas fa-users me-1"></i>
                                                                    {{ $laporan->pendukung->count() }} pendukung
                                                                </span>
                                                            </div>
                                                            <a class="btn btn-sm btn-outline-primary rounded-pill px-3"
                                                                href="{{ url('pelaporan/fasilitas/' . $laporan->id_fasilitas . '/show') }}">
                                                                <i class="fas fa-arrow-right me-1"></i> Detail
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="text-center py-5 my-4">
                                        <div class="empty-state-illustration mb-4">
                                            <img src="{{ asset('img/illustrations/no-reports.svg') }}" alt="No reports"
                                                class="img-fluid" style="max-height: 180px;">
                                        </div>
                                        <h4 class="text-muted mb-3">Anda belum membuat laporan</h4>
                                        <p class="text-muted mb-4">Mulai laporkan fasilitas yang perlu diperbaiki agar
                                            segera
                                            ditindaklanjuti.</p>
                                        <a href=""
                                            class="btn btn-primary px-4 rounded-pill">
                                            <i class="fas fa-plus me-2"></i>Buat Laporan Baru
                                        </a>
                                    </div>
                                @endif
                            </div>

                            <div class="tab-pane fade" id="pendukung" role="tabpanel" aria-labelledby="pendukung-tab">
                                @if (count($laporanDidukung) > 0)
                                    <div class="row g-4">
                                        @foreach ($laporanDidukung as $laporan)
                                            <div class="col-lg-6">
                                                <div class="card h-100 border-0 shadow-sm-hover">
                                                    <div
                                                        class="card-header d-flex justify-content-between align-items-center bg-light-primary bg-opacity-10">
                                                        <div class="d-flex flex-wrap gap-2">
                                                            <span
                                                                class="badge bg-{{ $laporan->status->color() }} bg-opacity-15 text-white border border-{{ $laporan->status->color() }} border-opacity-25">
                                                                {{ $laporan->status }}
                                                            </span>
                                                            <span class="badge bg-info bg-opacity-10 text-info">
                                                                <i class="fas fa-calendar-alt me-1"></i>
                                                                {{ \Carbon\Carbon::parse($laporan->waktu_pelaporan)->locale('id')->diffForHumans() }}
                                                            </span>
                                                        </div>
                                                        <span class="badge bg-secondary bg-opacity-10 text-secondary">
                                                            <i class="fas fa-user me-1"></i>
                                                            {{ $laporan->pengguna->name }}
                                                        </span>
                                                    </div>
                                                    <div class="card-body">
                                                        <h5 class="card-title text-primary mb-2">
                                                            <i
                                                                class="fas fa-building me-2"></i>{{ $laporan->fasilitas->nama }}
                                                        </h5>
                                                        <p class="card-text text-muted mb-3">
                                                            <i class="fas fa-quote-left me-1 text-muted opacity-50"></i>
                                                            {{ Str::limit($laporan->deskripsi, 120) }}
                                                        </p>

                                                        <div class="d-flex align-items-center mb-3">
                                                            <div class="flex-grow-1 me-3">
                                                                <div class="progress" style="height: 6px;">
                                                                    <div class="progress-bar bg-{{ $laporan->status_color }}"
                                                                        role="progressbar"
                                                                        style="width: {{ $laporan->progress }}%"
                                                                        aria-valuenow="{{ $laporan->progress }}"
                                                                        aria-valuemin="0" aria-valuemax="100"></div>
                                                                </div>
                                                            </div>
                                                            <small
                                                                class="text-{{ $laporan->status_color }} fw-semibold">{{ $laporan->progress }}%</small>
                                                        </div>

                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div class="d-flex flex-wrap gap-2">
                                                                <span class="badge bg-light text-dark">
                                                                    <i class="fas fa-users me-1"></i>
                                                                    {{ $laporan->pendukung->count() }} pendukung
                                                                </span>
                                                                @if ($laporan->is_pendukung_by_me)
                                                                    <span
                                                                        class="badge bg-success bg-opacity-10 text-success">
                                                                        <i class="fas fa-check-circle me-1"></i> Anda
                                                                        mendukung
                                                                    </span>
                                                                @endif
                                                            </div>
                                                            <a class="btn btn-sm btn-outline-primary rounded-pill px-3"
                                                                href="{{ url('pelaporan/fasilitas/' . $laporan->id_fasilitas . '/show') }}">
                                                                <i class="fas fa-arrow-right me-1"></i> Detail
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="text-center py-5 my-4">
                                        <div class="empty-state-illustration mb-4">
                                            <img src="{{ asset('template/assets/images/error-icon-4.png') }}"
                                                alt="No pendukung reports" class="img-fluid" style="max-height: 60px;">
                                        </div>
                                        <h4 class="text-muted mb-3">Anda belum mendukung laporan apa pun</h4>
                                        <p class="text-muted mb-4">Dukung laporan lain untuk membantu mempercepat proses
                                            perbaikan fasilitas.</p>
                                        <a href="{{ url('pelaporan') }}" class="btn btn-primary px-4 rounded-pill">
                                            <i class="fas fa-search me-2"></i>Cari Laporan
                                        </a>
                                    </div>
                                @endif
                            </div>

                            <div class="tab-pane fade" id="selesai" role="tabpanel" aria-labelledby="selesai-tab">
                                @if (count($laporanSelesai) > 0)
                                    <div class="row g-4">
                                        @foreach ($laporanSelesai as $laporan)
                                            <div class="col-lg-6">
                                                <div class="card h-100 border-0 shadow-sm-hover">
                                                    <div
                                                        class="card-header d-flex justify-content-between align-items-center bg-light-success bg-opacity-10">
                                                        <div class="d-flex flex-wrap gap-2">
                                                            <span
                                                                class="badge bg-success bg-opacity-15 text-white border border-success border-opacity-25">
                                                                {{ $laporan->status->label() }}
                                                            </span>
                                                            <span class="badge bg-info bg-opacity-10 text-info">
                                                                <i class="fas fa-calendar-alt me-1"></i>
                                                                {{ \Carbon\Carbon::parse($laporan->waktu_pelaporan)->locale('id')->diffForHumans() }}
                                                            </span>
                                                        </div>
                                                        <span class="badge bg-secondary bg-opacity-10 text-secondary">
                                                            <i class="fas fa-user me-1"></i>
                                                            {{ $laporan->pengguna->name }}
                                                        </span>
                                                    </div>

                                                    <div class="card-body">
                                                        <h5 class="card-title text-primary mb-2">
                                                            <i
                                                                class="fas fa-building me-2"></i>{{ $laporan->fasilitas->nama }}
                                                        </h5>
                                                        <p class="card-text text-muted mb-3">
                                                            <i class="fas fa-quote-left me-1 text-muted opacity-50"></i>
                                                            {{ Str::limit($laporan->deskripsi, 120) }}
                                                        </p>

                                                        <div class="feedback-section mb-3 p-3 bg-light rounded">
                                                            @if ($laporan->feedback)
                                                                <div class="d-flex align-items-start">
                                                                    <div
                                                                        class="bg-success bg-opacity-10 p-2 rounded-2 me-3">
                                                                        <i class="fas fa-comment-check text-success"></i>
                                                                    </div>
                                                                    <div>
                                                                        <h6 class="mb-1">Feedback Anda</h6>
                                                                        <p class="mb-0">{{ $laporan->feedback->ulasan }}
                                                                        </p>
                                                                        <div class="rating mt-1">
                                                                            @for ($i = 1; $i <= 5; $i++)
                                                                                <i
                                                                                    class="fas fa-star {{ $i <= $laporan->feedback->rating ? 'text-warning' : 'text-muted' }}"></i>
                                                                            @endfor
                                                                        </div>
                                                                        <small class="text-muted">
                                                                            Dikirim pada
                                                                            {{ $laporan->feedback->created_at->format('d M Y H:i') }}
                                                                        </small>
                                                                    </div>
                                                                </div>
                                                            @elseif(Auth::user()->id_pengguna == $laporan->id_pengguna)
                                                                <button
                                                                    class="btn btn btn-outline-success rounded-pill"
                                                                    data-bs-toggle="modal" data-bs-target="#feedbackModal"
                                                                    data-laporan-id="{{ $laporan->id_laporan }}"> 
                                                                    Beri Feedback
                                                                </button>
                                                            @else
                                                                <p class="text-muted mb-0">
                                                                    <i class="fas fa-info-circle me-1"></i>
                                                                    Menunggu feedback dari pelapor
                                                                </p>
                                                            @endif
                                                        </div>

                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div class="d-flex flex-wrap gap-2">
                                                                <span class="badge bg-light text-dark">
                                                                    <i class="fas fa-users me-1"></i>
                                                                    {{ $laporan->pendukung_count }} pendukung
                                                                </span>
                                                                @if ($laporan->is_pendukung_by_me)
                                                                    <span
                                                                        class="badge bg-success bg-opacity-10 text-success">
                                                                        <i class="fas fa-check-circle me-1"></i> Anda
                                                                        mendukung
                                                                    </span>
                                                                @endif
                                                            </div>
                                                            <a class="btn btn-sm btn-outline-primary rounded-pill px-3"
                                                                href="{{ url('pelaporan/fasilitas/' . $laporan->id_fasilitas . '/show') }}">
                                                                <i class="fas fa-arrow-right me-1"></i> Detail
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="text-center py-5 my-4">
                                        <div class="empty-state-illustration mb-4">
                                            <img src="{{ asset('img/illustrations/no-completed.svg') }}"
                                                alt="No completed reports" class="img-fluid" style="max-height: 180px;">
                                        </div>
                                        <h4 class="text-muted mb-3">Belum ada laporan selesai</h4>
                                        <p class="text-muted mb-4">Laporan yang sudah selesai akan muncul di sini.</p>
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

        <div class="modal fade" id="feedbackModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-light-success">
                        <h5 class="modal-title"><i class="fas fa-comment-medical me-2"></i>Beri Feedback</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="feedbackForm" method="POST">
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" name="id_laporan" id="feedbackLaporanId">
                            <div class="mb-3">
                                <label class="form-label">Rating</label>
                                <div class="rating-input">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="far fa-star rating-star" data-value="{{ $i }}"></i>
                                    @endfor
                                    <input type="hidden" name="rating" id="selectedRating" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="ulasan" class="form-label">Ulasan</label>
                                <textarea class="form-control" id="ulasan" name="ulasan" rows="3" required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-success">Kirim Feedback</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <script>
        function modalAction(url = '') {
            $('#myModal').load(url, function() {
                $('#myModal').modal('show');
            });
        }
    </script>
    @push('scripts')
        <script>
            $('#feedbackModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var laporanId = button.data('laporan-id');
                var modal = $(this);
                modal.find('#feedbackLaporanId').val(laporanId);
            });

            $('.rating-star').on('click', function() {
                const value = $(this).data('value');
                $('#selectedRating').val(value);
                $('.rating-star').each(function(i, star) {
                    if ($(star).data('value') <= value) {
                        $(star).removeClass('far').addClass('fas text-warning');
                    } else {
                        $(star).removeClass('fas text-warning').addClass('far');
                    }
                });
            });

            $('#feedbackForm').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: '',
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#feedbackModal').modal('hide');
                        location.reload(); // Refresh to show the new feedback
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan. Silakan coba lagi.');
                    }
                });
            });
        </script>
    @endpush
@endsection
