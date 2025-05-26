@extends('layout.app')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            {{-- Filter Section --}}
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

                {{-- Status Legend --}}
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

            {{-- Facilities List --}}
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

    {{-- Report Modal --}}
    <div class="modal fade" id="reportModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modalTitle">Laporkan Kerusakan</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="reportForm">
                    <div class="modal-body">
                        <input type="hidden" id="fasilitas_id" name="fasilitas_id">
                        <input type="hidden" id="existing_report_id" name="existing_report_id">
                        
                        {{-- New Report Section --}}
                        <div id="newReportSection">
                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi Kerusakan</label>
                                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required placeholder="Jelaskan kerusakan yang Anda temukan"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="foto" class="form-label">Upload Bukti Foto</label>
                                <input class="form-control" type="file" id="foto" name="foto" accept="image/*">
                                <small class="text-muted">Format: JPG, PNG (maks. 2MB)</small>
                            </div>
                        </div>
                        
                        {{-- Existing Report Section --}}
                        <div id="existingReportSection" style="display: none;">
                            <div class="alert alert-warning">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                <span>Fasilitas ini sudah memiliki laporan aktif. Anda hanya bisa mendukung laporan yang sudah ada.</span>
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
        // Handle building selection change
        $('#id_gedung').change(function() {
            const id_gedung = $(this).val();
            $('#id_ruangan').prop('disabled', !id_gedung);
            
            if (id_gedung) {
                $('#id_ruangan').html('<option value="">Memuat ruangan...</option>');
                
                // Fetch rooms for selected building
                $.get(`/pelaporan/ruangan-by-gedung/${id_gedung}`, function(data) {
                    if (data.length > 0) {
                        let options = '<option value="">Pilih Ruangan</option>';
                        data.forEach(function(ruangan) {
                            options += `<option value="${ruangan.id_ruangan}">${ruangan.nama}</option>`;
                        });
                        $('#id_ruangan').html(options);
                    } else {
                        $('#id_ruangan').html('<option value="">Tidak ada ruangan tersedia</option>');
                    }
                }).fail(function() {
                    $('#id_ruangan').html('<option value="">Gagal memuat ruangan</option>');
                });
            } else {
                $('#id_ruangan').html('<option value="">Pilih Ruangan</option>');
            }
        });

        // Handle form submission to load facilities
        $('#filterForm').submit(function(e) {
            e.preventDefault();
            const id_ruangan = $('#id_ruangan').val();
            
            if (!id_ruangan) {
                alert('Silakan pilih ruangan terlebih dahulu');
                return;
            }
            
            // Show loading state
            $('#facilitiesContainer').html(`
                <div class="text-center py-5">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-2">Memuat fasilitas...</p>
                </div>
            `);
            
            // Fetch facilities for selected room
            $.get(`/pelaporan/fasilitas-by-ruangan/${id_ruangan}`, function(data) {
                if (data.length > 0) {
                    renderFacilities(data);
                } else {
                    $('#facilitiesContainer').html(`
                        <div class="text-center text-muted py-5">
                            <i class="fas fa-exclamation-circle fa-3x mb-3"></i>
                            <p>Tidak ada fasilitas ditemukan untuk ruangan ini</p>
                        </div>
                    `);
                }
            }).fail(function() {
                $('#facilitiesContainer').html(`
                    <div class="text-center text-danger py-5">
                        <i class="fas fa-times-circle fa-3x mb-3"></i>
                        <p>Gagal memuat data fasilitas</p>
                    </div>
                `);
            });
        });

        // Function to render facilities list
        function renderFacilities(facilities) {
            let html = '<div class="list-group">';
            
            facilities.forEach(function(fasilitas) {
                const hasReport = fasilitas.jumlah_laporan > 0;
                const badgeClass = hasReport ? 'bg-warning' : 'bg-success';
                const statusText = hasReport ? 'Ada laporan' : 'Belum ada laporan';
                
                html += `
                    <div class="list-group-item list-group-item-action">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1">${fasilitas.nama}</h6>
                                <small class="text-muted">${fasilitas.kategori}</small>
                            </div>
                            <span class="badge ${badgeClass}">${statusText}</span>
                        </div>
                        <div class="mt-2 d-flex justify-content-end">
                            <button class="btn btn-sm ${hasReport ? 'btn-outline-warning' : 'btn-primary'} report-btn"
                                data-fasilitas-id="${fasilitas.id_fasilitas}"
                                data-fasilitas-nama="${fasilitas.nama}"
                                ${hasReport ? 'data-existing-report="'+encodeURIComponent(JSON.stringify(fasilitas.laporan_terakhir))+'"' : ''}>
                                ${hasReport ? '<i class="fas fa-thumbs-up me-1"></i>Dukung Laporan' : '<i class="fas fa-flag me-1"></i>Laporkan'}
                            </button>
                        </div>
                    </div>
                `;
            });
            
            html += '</div>';
            $('#facilitiesContainer').html(html);
        }

        // Handle report button click
        $(document).on('click', '.report-btn', function() {
            const fasilitasId = $(this).data('fasilitas-id');
            const fasilitasNama = $(this).data('fasilitas-nama');
            const existingReportData = $(this).data('existing-report');
            
            $('#fasilitas_id').val(fasilitasId);
            $('#modalTitle').text(`Laporkan Kerusakan - ${fasilitasNama}`);
            
            if (existingReportData) {
                const existingReport = JSON.parse(decodeURIComponent(existingReportData));
                
                // Show existing report section
                $('#existingReportSection').show();
                $('#newReportSection').hide();
                $('#existing_report_id').val(existingReport.id);
                
                // Populate existing report details
                $('#reportDescription').text(existingReport.deskripsi);
                $('#reportDate').text(`Dilaporkan pada: ${existingReport.tanggal_laporan} oleh ${existingReport.pelapor_pertama}`);
                
                let imageHtml = '';
                if (existingReport.foto) {
                    imageHtml = `<img src="/storage/${existingReport.foto}" class="img-fluid rounded mt-2" alt="Bukti Foto">`;
                }
                $('#reportImage').html(imageHtml);
                
                $('#submitButtonText').html('<i class="fas fa-thumbs-up me-2"></i>Dukung Laporan');
            } else {
                // Show new report section
                $('#existingReportSection').hide();
                $('#newReportSection').show();
                $('#existing_report_id').val('');
                $('#deskripsi').val('');
                $('#foto').val('');
                $('#submitButtonText').html('<i class="fas fa-paper-plane me-2"></i>Kirim Laporan');
            }
            
            $('#reportModal').modal('show');
        });

        // Handle report form submission
        $('#reportForm').submit(function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const isSupporting = $('#existing_report_id').val() !== '';
            
            // Show loading state on button
            const submitBtn = $('#submitReportBtn');
            submitBtn.prop('disabled', true);
            submitBtn.html('<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Memproses...');
            
            $.ajax({
                url: isSupporting ? '/pelaporan/dukung' : '/pelaporan',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $('#reportModal').modal('hide');
                    
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: isSupporting ? 'Terima kasih telah mendukung laporan ini' : 'Laporan kerusakan berhasil dikirim',
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        // Refresh the facilities list
                        $('#filterForm').submit();
                    });
                },
                error: function(xhr) {
                    submitBtn.prop('disabled', false);
                    $('#submitButtonText').html(isSupporting ? '<i class="fas fa-thumbs-up me-2"></i>Dukung Laporan' : '<i class="fas fa-paper-plane me-2"></i>Kirim Laporan');
                    
                    let errorMessage = xhr.responseJSON?.message || 'Terjadi kesalahan saat mengirim laporan';
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: errorMessage,
                    });
                }
            });
        });
    });
</script>
@endpush