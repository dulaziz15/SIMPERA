@extends('layout.app')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white py-3">
                        <h4 class="mb-0 text-white"><i class="fas fa-tools me-2"></i>Daftar Penugasan Saya</h4>
                    </div>
                    <div class="card-body">
                        <!-- Filter Section -->
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <label class="form-label">Status</label>
                                <select class="form-select" id="filter-status">
                                    <option value="">Semua Status</option>
                                    <option value="dalam penugasan">Dalam Penugasan</option>
                                    <option value="dalam perbaikan">Dalam Perbaikan</option>
                                    <option value="selesai">Selesai</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Prioritas</label>
                                <select class="form-select" id="filter-priority">
                                    <option value="">Semua Prioritas</option>
                                    <option value="tinggi">Tinggi</option>
                                    <option value="sedang">Sedang</option>
                                    <option value="rendah">Rendah</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Tanggal</label>
                                <input type="date" class="form-control" id="filter-date">
                            </div>
                        </div>

                        <!-- Assignment List -->
                        <div class="table-responsive">
                            <table class="table table-hover align-middle" id="assignments-table">
                                <thead class="table-light">
                                    <tr>
                                        <th width="5%">#</th>
                                        <th width="20%">Laporan</th>
                                        <th width="15%">Pelapor</th>
                                        <th width="15%">Tanggal</th>
                                        <th width="15%">Status</th>
                                        <th width="15%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($penugasan as $tugas)
                                        @if ($tugas->status_progres == 'proses')
                                            <tr class="{{ $tugas->status == 'selesai' ? 'table-success' : '' }}">
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0">
                                                            <img src="{{ asset('storage/uploads/laporan/' . $tugas->laporan->url_foto) }}"
                                                                class="rounded" width="40" height="40"
                                                                style="object-fit: cover;">
                                                        </div>
                                                        <div class="flex-grow-1 ms-2">
                                                            <h6 class="mb-0">
                                                                {{ Str::limit($tugas->laporan->deskripsi, 30) }}
                                                            </h6>
                                                            <small
                                                                class="text-muted">#{{ $tugas->laporan->id_laporan }}</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ $tugas->laporan->pengguna->profil->nama_lengkap }}</td>
                                                <td>{{ $tugas->laporan->waktu_pelaporan }}</td>
                                                <td>
                                                    {{-- @dd($tugas->status_progres) --}}
                                                    <span
                                                        class="badge bg-{{ $tugas->status_progres == 'selesai' ? 'success' : ($tugas->status_progres == 'penugasan' ? 'primary' : 'warning') }}">
                                                        {{ $tugas->status_progres }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-success view-detail"
                                                        onclick="showSelesaiPenugasan({{ $tugas->id_penugasan }})">
                                                        <i class="fas fa-check"></i> Selesaikan Penugsan
                                                    </button>
                                                    <!-- Submission Modal -->
                                                    <div class="modal fade" id="selesaikanPenugasan" tabindex="-1"
                                                        aria-labelledby="terimaPenugasanLabel" aria-hidden="true">
                                                        @include(
                                                            'perbaikan.component.modal_selesai_penugasan',
                                                            [
                                                                'item' => $tugas,
                                                            ]
                                                        );
                                                    </div>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-body">
                        <!-- Assignment List -->
                        <div class="table-responsive">
                            <table class="table table-hover align-middle" id="assignments-table">
                                <thead class="table-light">
                                    <tr>
                                        <th width="5%">#</th>
                                        <th width="20%">Laporan</th>
                                        <th width="15%">Pelapor</th>
                                        <th width="15%">Tanggal</th>
                                        <th width="15%">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($penugasan as $tugas)
                                        @if ($tugas->status_progres == 'selesai')
                                            <tr class="{{ $tugas->status == 'selesai' ? 'table-success' : '' }}">
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0">
                                                            <img src="{{ asset('storage/uploads/laporan/' . $tugas->laporan->url_foto) }}"
                                                                class="rounded" width="40" height="40"
                                                                style="object-fit: cover;">
                                                        </div>
                                                        <div class="flex-grow-1 ms-2">
                                                            <h6 class="mb-0">
                                                                {{ Str::limit($tugas->laporan->deskripsi, 30) }}
                                                            </h6>
                                                            <small
                                                                class="text-muted">#{{ $tugas->laporan->id_laporan }}</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>{{ $tugas->laporan->pengguna->profil->nama_lengkap }}</td>
                                                <td>{{ $tugas->laporan->waktu_pelaporan }}</td>
                                                <td>
                                                    {{-- @dd($tugas->status_progres) --}}
                                                    <span
                                                        class="badge bg-{{ $tugas->status_progres == 'selesai' ? 'success' : ($tugas->status_progres == 'penugasan' ? 'primary' : 'warning') }}">
                                                        {{ $tugas->status_progres }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .assignment-card {
            border-radius: 10px;
            border: none;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .assignment-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .badge {
            font-weight: 500;
            +padding: 5px 10px;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(106, 17, 203, 0.05);
        }

        .status-badge {
            font-size: 0.75rem;
            padding: 5px 10px;
            border-radius: 20px;
        }
    </style>
@endpush

@push('scripts')
    <script>
        function showSelesaiPenugasan(idPenugasan) {
            currentLaporanId = idPenugasan;
            $('#selesaikanPenugasan').modal('show');
        }

        $(document).ready(function() {
            // Load assignment detail
            $('.view-detail').click(function() {
                const id = $(this).data('id');
                $('#modalDetailContent').load('/teknisi/penugasan/' + id + '/detail');
            });

            // Start repair process
            $('.start-repair').click(function() {
                const id = $(this).data('id');
                $('#penugasan_id').val(id);
                $('#repairModal').modal('show');
            });

            // Update progress value display
            $('#progressRange').on('input', function() {
                $('#progressValue').text($(this).val() + '%');
            });

            // Submit repair form
            $('#repairForm').submit(function(e) {
                e.preventDefault();
                const formData = new FormData(this);

                $.ajax({
                    url: '/teknisi/penugasan/perbaikan',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Status perbaikan berhasil diperbarui',
                            timer: 1500
                        }).then(() => {
                            location.reload();
                        });
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: xhr.responseJSON.message || 'Terjadi kesalahan'
                        });
                    }
                });
            });

            // Filter assignments
            $('#filter-status, #filter-priority, #filter-date').change(function() {
                const status = $('#filter-status').val();
                const priority = $('#filter-priority').val();
                const date = $('#filter-date').val();

                // You would typically make an AJAX call here to filter data
                // For demo, we'll just hide/show rows
                $('#assignments-table tbody tr').each(function() {
                    const rowStatus = $(this).find('td:nth-child(6) span').text().toLowerCase();
                    const rowPriority = $(this).find('td:nth-child(5) span').text().toLowerCase();
                    const rowDate = $(this).find('td:nth-child(4)').text();

                    const statusMatch = !status || rowStatus.includes(status);
                    const priorityMatch = !priority || rowPriority.includes(priority);
                    const dateMatch = !date || rowDate.includes(date.split('-').reverse().join(
                        '/'));

                    $(this).toggle(statusMatch && priorityMatch && dateMatch);
                });
            });
        });
    </script>
@endpush
