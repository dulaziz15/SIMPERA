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
                                                            {{ Str::limit($laporan->komentar, 120) }}
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
                                        <a href="" class="btn btn-primary px-4 rounded-pill">
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
                                                            {{ Str::limit($laporan->komentar, 120) }}
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
                                                            {{ Str::limit($laporan->komentar, 120) }}
                                                        </p>

                                                        <div class="feedback-section mb-4 p-3 bg-light rounded-3 border">
                                                            @forelse ($laporan->feedback as $item)
                                                                <div
                                                                    class="feedback-item mb-3 p-3 bg-white rounded-2 shadow-sm">
                                                                    <div class="d-flex align-items-start">
                                                                        <div
                                                                            class="bg-success bg-opacity-10 p-2 rounded-circle me-3">
                                                                            <i
                                                                                class="fas fa-comment-medical"></i>
                                                                        </div>
                                                                        <div class="flex-grow-1">
                                                                            <div
                                                                                class="d-flex justify-content-between align-items-center mb-2">
                                                                                <h6 class="mb-0 fw-semibold">Feedback Anda
                                                                                </h6>
                                                                                <small class="text-muted">
                                                                                    {{ $item->created_at }}
                                                                                </small>
                                                                            </div>
                                                                            <p class="mb-2">{{ $item->komentar }}</p>
                                                                            <div class="rating">
                                                                                @for ($i = 1; $i <= 5; $i++)
                                                                                    <i class="{{ $i <= $item->penilaian ? 'fas fa-star rating-star text-warning' : 'far fa-star rating-star' }}"></i>
                                                                                @endfor
                                                                                <span
                                                                                    class="ms-2 small text-muted">{{ $item->rating }}/5</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @empty
                                                                @if (Auth::user()->id_pengguna == $item->id_pengguna)
                                                                    <div class="text-center py-3">
                                                                        <button
                                                                            class="btn btn-outline-success rounded-pill px-4"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#feedbackModal"
                                                                            data-laporan-id="{{ $laporan->id_laporan }}">
                                                                            <i class="fas fa-comment-medical me-2"></i>
                                                                            Beri Feedback
                                                                        </button>
                                                                        <p class="small text-muted mt-2 mb-0">
                                                                            Bagikan pengalaman Anda tentang penanganan
                                                                            laporan ini
                                                                        </p>
                                                                    </div>
                                                                @endif
                                                            @endforelse
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
    <div class="modal fade" id="feedbackModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-light-success">
                    <h5 class="modal-title"><i class="fas fa-comment-medical me-2"></i>Beri Feedback</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ url('feedback/store') }}" id="feedbackForm" method="POST" class="needs-validation">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="id_laporan" id="feedbackLaporanId">
                        <input type="hidden" name="id_pengguna" value="{{ Auth::user()->id_pengguna }}">
                        <div class="form-group">
                            <div class="mb-3">
                                <label class="form-label">Rating</label>
                                <div class="rating-input">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="far fa-star rating-star" data-value="{{ $i }}"></i>
                                    @endfor
                                    <input type="hidden" name="penilaian" id="penilaian" required>
                                </div>
                            </div>
                            <div id="error-penilaian" class="error-text"></div>
                        </div>
                        <div class="form-group">
                            <div class="mb-3">
                                <label for="komentar" class="form-label">komentar</label>
                                <textarea class="form-control" id="komentar" name="komentar" rows="3" required></textarea>
                            </div>
                            <div id="error-komentar" class="error-text"></div>
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
    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#feedbackModal').on('show.bs.modal', function(event) {
                    var button = $(event.relatedTarget);
                    var laporanId = button.data('laporan-id');
                    var modal = $(this);
                    modal.find('#feedbackLaporanId').val(laporanId);
                });

                $('.rating-star').on('click', function() {
                    const value = $(this).data('value');
                    $('#penilaian').val(value);
                    $('.rating-star').each(function(i, star) {
                        if ($(star).data('value') <= value) {
                            $(star).removeClass('far').addClass('fas text-warning');
                        } else {
                            $(star).removeClass('fas text-warning').addClass('far');
                        }
                    });
                });

                $('#feedbackForm').validate({
                    rules: {
                        penilaian: {
                            required: true,
                        },
                        komentar: {
                            required: true,
                        }
                    },
                    messages: {
                        penilaian: {
                            required: "Wajib mengisi rating",
                        },
                        komentar: {
                            required: "Wajib Mengisi komentar",
                        }
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
                                    $('#myModal').modal('hide');
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Data Berhasil Ditambahkan',
                                        text: response.message
                                    });
                                    dataPelaporan.ajax.reload();
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

                // Reset form when modal closes
                $('#feedbackModal').on('hidden.bs.modal', function() {
                    $('#feedbackForm')[0].reset();
                    $('.rating-star').addClass('far').removeClass('fas active');
                    $('#penilaian').val('');
                    $(this).find('button[type="submit"]').prop('disabled', false).html(
                        '<i class="fas fa-paper-plane me-1"></i> Kirim Feedback');
                });
            });
        </script>
    @endpush
@endsection
