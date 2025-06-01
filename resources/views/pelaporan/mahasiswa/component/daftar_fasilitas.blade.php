<div class="card">
    <div class="card-body">
        <div class="report-details">
            <div class="d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom">
                <h4 class="h5 mb-0 fw-semibold text-dark">${fasilitas.nama}</h4>
                <span
                    class="badge bg-${fasilitas.memiliki_laporan_aktif.style} bg-opacity-10 text-${fasilitas.memiliki_laporan_aktif.style} rounded-pill px-3 py-2 fw-normal">${fasilitas.memiliki_laporan_aktif.status}</span>
            </div>

            <div class="vstack gap-3 mb-4">
                <div class="d-flex align-items-start">
                    <div class="bg-info bg-opacity-10 p-2 rounded-2 me-3"><i class="fas fa-map-marker-alt text-info"></i>
                    </div>
                    <div>
                        <h5 class="h6 text-secondary mb-1">Lokasi</h5>
                        <div class="d-flex flex-wrap gap-3">
                            <div>
                                <p class="mb-1 small text-muted">Ruangan</p>
                                <p class="mb-0 fw-medium">${fasilitas.ruangan.nama}</p>
                            </div>
                            <div>
                                <p class="mb-1 small text-muted">Gedung</p>
                                <p class="mb-0 fw-medium">${fasilitas.ruangan.gedung.nama}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex align-items-start">
                    <div class="bg-info bg-opacity-10 p-2 rounded-2 me-3"><i class="fas fa-tag text-info"></i></div>
                    <div>
                        <h5 class="h6 text-secondary mb-1">Kategori & Status</h5>
                        <div class="d-flex flex-wrap gap-3">
                            <div>
                                <p class="mb-1 small text-muted">Kategori</p>
                                <p class="mb-0 fw-medium">${fasilitas.kategori.nama}</p>
                            </div>
                            <div>
                                <p class="mb-1 small text-muted">Status</p><span
                                    class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-1">${fasilitas.status}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex align-items-start">
                    <div class="bg-info bg-opacity-10 p-2 rounded-2 me-3"><i class="fas fa-calendar-alt text-info"></i>
                    </div>
                    <div>
                        <h5 class="h6 text-secondary mb-1">Tahun & Pembaruan</h5>
                        <div class="d-flex flex-wrap gap-3">
                            <div>
                                <p class="mb-1 small text-muted">Tahun</p>
                                <p class="mb-0 fw-medium">${fasilitas.dibuat}</p>
                            </div>
                            <div>
                                <p class="mb-1 small text-muted">Terakhir Diperiksa</p>
                                <p class="mb-0 fw-medium">${fasilitas.terakhir_update}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-4">
                <div class="d-flex justify-content-center gap-3">
                    <a href="{{ url('pelaporan/fasilitas/${fasilitas.id}/show') }}"
                        class="btn btn-outline-primary rounded-pill px-4 py-2 fw-medium hover-scale"><i
                            class="fas fa-eye me-2"></i>Detail</a>
                    <button class="btn btn-outline-primary rounded-pill px-4 py-2 fw-medium hover-scale"
                        data-fasilitas-id="${fasilitas.id}"
                        onclick="modalImageFasilitas('{{ asset('storage/uploads/fasilitas/${fasilitas.gambar}') }}')"><i
                            class="fas fa-image me-2"></i>Foto</button>
                </div>
            </div>
        </div>
    </div>
</div>
