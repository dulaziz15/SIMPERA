<div id="modal-master" class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Data Kategori Gedung</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Kategori Gedung</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $kategori->kategori_gedung }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Batal</button>
        </div>
    </div>
</div>
