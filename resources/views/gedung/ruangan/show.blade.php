<div id="modal-master" class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modalShowruanganLabel">Detail ruangan</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body row g-3 p-4">
            <div class="card">
                <div class="card-body">
                    <table class="table table-sm table-bordered table-striped">
                        <tr>
                            <th>Nama Gedung</th>
                            <td>{{ $ruangan->gedung->nama }}</td>
                        </tr>
                        <tr>
                            <th>Nama ruangan</th>
                            <td>{{ $ruangan->nama }}</td>
                        </tr>
                        <tr>
                            <th>Kode ruangan</th>
                            <td>{{ $ruangan->kode }}</td>
                        </tr>
                        <tr>
                            <th>Dibuat Pada</th>
                            <td>{{ $ruangan->created_at->format('d-m-Y') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        </div>
    </div>
</div>