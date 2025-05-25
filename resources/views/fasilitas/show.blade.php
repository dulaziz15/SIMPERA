<div id="modal-master" class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modalShowPeranLabel">Detail User</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body row g-3 p-4">
            <div class="card">
                <div class="card-body">
                    <div class="data mt-4">
                        <table class="table table-sm table-bordered table-striped">
                            <tr>
                                <th>Nama Fasilitas</th>
                                <td>:</td>
                                <td>{{ $fasilitas->nama }}</td>
                            </tr>
                            <tr>
                                <th>Kategori</th>
                                <td>:</td>
                                <td>{{ $fasilitas->kategori->nama }}</td>
                            </tr>
                            <tr>
                                <th>Ruangan</th>
                                <td>:</td>
                                <td>{{ $fasilitas->ruangan->nama }}</td>
                            </tr>
                            <tr>
                                <th>Gedung</th>
                                <td>:</td>
                                <td>{{ $fasilitas->ruangan->gedung->nama }}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>:</td>
                                <td>{{ $fasilitas->status }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        </div>
    </div>