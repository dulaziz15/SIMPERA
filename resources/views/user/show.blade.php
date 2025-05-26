
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Show Data User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body row g-3">
                {{ $user->nama_pengguna }}
            </div>
            <div class="modal-footer">
                
                <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>