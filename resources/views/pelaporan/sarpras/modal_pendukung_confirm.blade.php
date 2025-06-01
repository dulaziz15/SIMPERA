<div class="modal fade" id="confirmModalDelete" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="form-delete" method="POST">
            @csrf
            @method('DELETE')
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header text-white">
                    <h5 class="modal-title" id="modal-delete-title">
                        <i class="fas fa-exclamation-triangle me-2"></i>Konfirmasi Penghapusan
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modal-delete-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Batal
                    </button>
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash-alt me-2"></i>Ya, Hapus
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>