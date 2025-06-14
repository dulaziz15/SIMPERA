<div id="modal-master" class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Data Periode</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body row g-3 p-4">
            <div class="card">
                <div class="card-body">
                    <div class="data mt-4">
                        <table class="table table-sm table-bordered table-striped">
                            <tr>
                                <th>Nama Periode</th>
                                <td>:</td>
                                <td>{{ $periode->nama }}</td>
                            </tr>
                            <tr>
                                <th>Budget Perbaikan</th>
                                <td>:</td>
                                <td>{{ $periode->biaya }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Mulai</th>
                                <td>:</td>
                                <td>{{ $periode->tanggal_mulai }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Selesai</th>
                                <td>:</td>
                                <td>{{ $periode->tanggal_selesai }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                <i class="fas fa-times me-2"></i>Batal
            </button>
        </div>
    </div>
</div>
