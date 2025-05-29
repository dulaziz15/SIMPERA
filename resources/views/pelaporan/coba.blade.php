@extends('layout.app')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            
            <div class="col-md-4">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fas fa-filter me-2"></i>Filter Lokasi</h5>
                    </div>
                    <div class="card-body">
                        <form id="filterForm">
                            <div class="mb-3">
                                <label class="form-label">Gedung</label>
                                <select class="form-select" id="id_gedung" name="id_gedung" required>
                                    <option value="">Pilih Gedung</option>
                                    @foreach ($gedung as $g)
                                        <option value="{{ $g->id_gedung }}">{{ $g->nama }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Ruangan</label>
                                <select class="form-select" id="id_ruangan" name="id_ruangan" disabled required>
                                    <option value="">Pilih Ruangan</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-search me-2"></i>Cari Fasilitas
                            </button>
                        </form>
                    </div>
                </div>

                
                <div class="card shadow-sm">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Status Fasilitas</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <div class="badge bg-success me-2" style="width: 20px; height: 20px;"></div>
                            <span>Belum ada laporan</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="badge bg-warning me-2" style="width: 20px; height: 20px;"></div>
                            <span>Sudah ada laporan</span>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fas fa-list me-2"></i>Daftar Fasilitas</h5>
                    </div>
                    <div class="card-body">
                        <div id="facilitiesContainer">
                            <div class="text-center text-muted py-5">
                                <i class="fas fa-building fa-3x mb-3"></i>
                                <p>Silakan pilih gedung dan ruangan untuk melihat daftar fasilitas</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="modal fade" id="reportModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modalTitle">Laporkan Kerusakan</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form id="reportForm">
                    <div class="modal-body">
                        <input type="hidden" id="fasilitas_id" name="fasilitas_id">
                        <input type="hidden" id="existing_report_id" name="existing_report_id">

                        
                        <div id="newReportSection">
                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi Kerusakan</label>
                                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required
                                    placeholder="Jelaskan kerusakan yang Anda temukan"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="foto" class="form-label">Upload Bukti Foto</label>
                                <input class="form-control" type="file" id="foto" name="foto" accept="image/*">
                                <small class="text-muted">Format: JPG, PNG (maks. 2MB)</small>
                            </div>
                        </div>

                        
                        <div id="existingReportSection" style="display: none;">
                            <div class="alert alert-warning">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                <span>Fasilitas ini sudah memiliki laporan aktif. Anda hanya bisa mendukung laporan yang
                                    sudah ada.</span>
                            </div>
                            <div id="existingReportDetails" class="mb-3 p-3 bg-light rounded">
                                <h6>Detail Laporan Terkini:</h6>
                                <p id="reportDescription"></p>
                                <small class="text-muted" id="reportDate"></small>
                                <div class="mt-2" id="reportImage"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" id="submitReportBtn">
                            <span id="submitButtonText"></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#id_gedung').change(function() {
                const id_gedung = $(this).val();
                $('#id_ruangan').prop('disabled', !id_gedung);

                if (id_gedung) {
                    $('#id_ruangan').html('<option value="">Memuat ruangan...</option>');

                    $.get(`/pelaporan/ruangan-by-gedung/${id_gedung}`, function(data) {
                        if (data.length > 0) {
                            let options = '<option value="">Pilih Ruangan</option>';
                            data.forEach(function(ruangan) {
                                options +=
                                    `<option value="${ruangan.id_ruangan}">${ruangan.nama}</option>`;
                            });
                            $('#id_ruangan').html(options);
                        } else {
                            $('#id_ruangan').html(
                                '<option value="">Tidak ada ruangan tersedia</option>');
                        }
                    }).fail(function() {
                        $('#id_ruangan').html('<option value="">Gagal memuat ruangan</option>');
                    });
                } else {
                    $('#id_ruangan').html('<option value="">Pilih Ruangan</option>');
                }
            });

            $('#filterForm').submit(function(e) {
                e.preventDefault();
                const id_ruangan = $('#id_ruangan').val();

                if (!id_ruangan) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Peringatan',
                        text: 'Silakan pilih ruangan terlebih dahulu',
                        confirmButtonColor: '#405189'
                    });
                    return;
                }

                showLoadingState();

                $.get(`/pelaporan/all-fasilitas-by-ruangan/${id_ruangan}`, function(data) {
                    $.get(`/pelaporan/fasilitas-empty-laporan/${data.id_fasilitas}`, function(
                    data) {
                        if (data.length > 0) {
                            renderFacilities(data);
                            initializeReportButtons();
                        } else {
                            showNoDataState();
                        }
                    });
                }).fail(function() {
                    showErrorState();
                });
            });

            function showLoadingState() {
                $('#facilitiesContainer').html(`
        <div class="text-center py-5">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mt-2">Memuat fasilitas...</p>
        </div>
    `);
            }

            function showNoDataState() {
                $('#facilitiesContainer').html(`
        <div class="text-center text-muted py-5">
            <i class="fas fa-exclamation-circle fa-3x mb-3"></i>
            <p>Tidak ada fasilitas ditemukan untuk ruangan ini</p>
        </div>
    `);
            }

            function showErrorState() {
                $('#facilitiesContainer').html(`
        <div class="text-center text-danger py-5">
            <i class="fas fa-times-circle fa-3x mb-3"></i>
            <p>Gagal memuat data fasilitas</p>
            <button class="btn btn-sm btn-primary mt-2" onclick="$('#filterForm').submit()">
                <i class="fas fa-sync-alt me-1"></i>Coba Lagi
            </button>
        </div>
    `);
            }

            function renderFacilities(facilities) {
                let html = '<div class="list-group">';

                facilities.sort((a, b) => b.jumlah_laporan - a.jumlah_laporan);

                facilities.forEach(function(fasilitas) {
                    const hasReport = fasilitas.jumlah_laporan > 0;
                    const badgeClass = hasReport ? 'bg-warning' : 'bg-success';
                    const statusText = hasReport ?
                        `${fasilitas.jumlah_laporan} laporan` :
                        'Belum ada laporan';

                    const latestReport = hasReport ? fasilitas.laporan_terakhir : null;

                    html += `
            <div class="list-group-item list-group-item-action">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-1">${fasilitas.nama}</h6>
                        <small class="text-muted">${fasilitas.kategori || 'Tidak ada kategori'}</small>
                    </div>
                    <span class="badge ${badgeClass}">${statusText}</span>
                </div>
                
                ${hasReport ? renderReportDetails(latestReport) : ''}
                
                <div class="mt-2 d-flex justify-content-end">
                    <button class="btn btn-sm ${hasReport ? 'btn-outline-warning' : 'btn-primary'} report-btn"
                        data-fasilitas-id="${fasilitas.id_fasilitas}"
                        data-fasilitas-nama="${fasilitas.nama}"
                        ${hasReport ? 'data-existing-report="'+encodeURIComponent(JSON.stringify(latestReport))+'"' : ''}>
                        ${hasReport ? '<i class="fas fa-thumbs-up me-1"></i>Dukung Laporan' : '<i class="fas fa-flag me-1"></i>Laporkan'}
                    </button>
                </div>
            </div>
        `;
                });

                html += '</div>';
                $('#facilitiesContainer').html(html);
            }

            function renderReportDetails(report) {
                if (!report) return '';

                const statusBadge = {
                    'baru': 'bg-secondary',
                    'proses': 'bg-primary',
                    'selesai': 'bg-success'
                } [report.status] || 'bg-secondary';

                return `
        <div class="alert alert-light mt-2 p-2">
            <div class="d-flex justify-content-between">
                <small class="text-muted">Laporan terakhir:</small>
                <span class="badge ${statusBadge}">${report.status || 'unknown'}</span>
            </div>
            <p class="mb-1 small">${report.deskripsi || 'Tidak ada deskripsi'}</p>
            <small class="text-muted">${formatDate(report.created_at)}</small>
        </div>
    `;
            }

            function formatDate(dateString) {
                if (!dateString) return '';
                const options = {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                };
                return new Date(dateString).toLocaleDateString('id-ID', options);
            }

            function initializeReportButtons() {
                $('.report-btn').click(function() {
                    const fasilitasId = $(this).data('fasilitas-id');
                    const fasilitasNama = $(this).data('fasilitas-nama');
                    const existingReport = $(this).data('existing-report');

                    if (existingReport) {
                        showSupportReportModal(JSON.parse(decodeURIComponent(existingReport)));
                    } else {
                        showNewReportModal(fasilitasId, fasilitasNama);
                    }
                });
            }

            function showNewReportModal(fasilitasId, fasilitasNama) {
                Swal.fire({
                    title: `Laporkan Fasilitas`,
                    html: `Anda akan melaporkan fasilitas <b>${fasilitasNama}</b>`,
                    input: 'textarea',
                    inputLabel: 'Deskripsi Kerusakan',
                    inputPlaceholder: 'Jelaskan kerusakan yang ditemukan...',
                    inputAttributes: {
                        'aria-label': 'Jelaskan kerusakan yang ditemukan'
                    },
                    showCancelButton: true,
                    confirmButtonText: 'Laporkan',
                    cancelButtonText: 'Batal',
                    showLoaderOnConfirm: true,
                    preConfirm: (description) => {
                        if (!description) {
                            Swal.showValidationMessage('Deskripsi kerusakan wajib diisi');
                            return false;
                        }

                        return submitNewReport(fasilitasId, description);
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Laporan berhasil dikirim',
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            $('#filterForm').submit(); 
                        });
                    }
                });
            }

            function submitNewReport(fasilitasId, description) {
                return $.ajax({
                    url: '/pelaporan',
                    type: 'POST',
                    data: {
                        id_fasilitas: fasilitasId,
                        deskripsi: description,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: 'json'
                }).then(response => {
                    return response;
                }).catch(error => {
                    Swal.showValidationMessage(
                        `Gagal mengirim laporan: ${error.responseJSON?.message || 'Error tidak diketahui'}`
                    );
                    return false;
                });
            }

            function showSupportReportModal(report) {
                Swal.fire({
                    title: `Dukung Laporan`,
                    html: `
            <div class="text-start">
                <p>Anda akan mendukung laporan untuk fasilitas <b>${report.fasilitas?.nama || 'Unknown'}</b></p>
                <div class="alert alert-light p-2">
                    <p class="mb-1">${report.deskripsi || 'Tidak ada deskripsi'}</p>
                    <small class="text-muted">${formatDate(report.created_at)}</small>
                </div>
            </div>
        `,
                    input: 'textarea',
                    inputLabel: 'Tambahkan keterangan (opsional)',
                    inputPlaceholder: 'Tambahkan informasi tambahan jika perlu...',
                    showCancelButton: true,
                    confirmButtonText: 'Dukung Laporan',
                    cancelButtonText: 'Batal',
                    showLoaderOnConfirm: true,
                    preConfirm: (additionalInfo) => {
                        return submitSupportReport(report.id_laporan, additionalInfo);
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Dukungan berhasil dikirim',
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            $('#filterForm').submit(); 
                        });
                    }
                });
            }

            function submitSupportReport(reportId, additionalInfo) {
                return $.ajax({
                    url: '/pelaporan/' + reportId + '/dukung',
                    type: 'POST',
                    data: {
                        deskripsi: additionalInfo || '',
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: 'json'
                }).then(response => {
                    return response;
                }).catch(error => {
                    Swal.showValidationMessage(
                        `Gagal mengirim dukungan: ${error.responseJSON?.message || 'Error tidak diketahui'}`
                    );
                    return false;
                });
            }

            $(document).ready(function() {
                if ($('#id_ruangan').val()) {
                    $('#filterForm').submit();
                }
            });
        });
    </script>
@endpush
