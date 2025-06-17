<div id="modal-master" class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Show Data Gedung</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <table class="table table-sm table-bordered table-striped">
                    <tr>
                        <td>Kategori Gedung</td>
                        <td>:</td>
                        <td>{{ $gedung->kategori_gedung->kategori_gedung }}</td>
                    </tr>
                    <tr>
                        <td>Nama Gedung</td>
                        <td>:</td>
                        <td>{{ $gedung->nama }}</td>
                    </tr>
            </table>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Batal</button>
        </div>
    </div>
</div>
