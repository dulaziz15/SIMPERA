<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="confirmModalLabel">Konfirmasi
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <p id="confirmMessage">Apakah Anda yakin ingin Menyelesaikan Penugasan Ini ?</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="button" class="btn btn-primary" id="confirmSelesaiPenugasan">Ya, Selesai</button>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        $('#confirmSelesaiPenugasan').click(function() {
            if (currentLaporanId) {
                $.ajax({
                    url: "{{ url('penugasan/') }}/" + currentLaporanId + "/selesai",
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                        'Accept': 'application/json'
                    },
                    success: function(response) {
                        $('#terimaPenugasan').modal('hide');
                        if (response.status) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.message,
                                timer: 1000,
                                showConfirmButton: false
                            }).then(function() {
                                window.location.reload();
                            });
                        } else {
                            $('#terimaPenugasan').modal('hide');
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: response.message
                            }).then(function() {
                                window.location.reload();
                            });
                        }
                    },
                    error: function(xhr) {
                        $('#terimaPenugasan').modal('hide');
                        showErrorAlert(xhr.responseJSON?.message || 'Terjadi kesalahan server');
                    }
                });
            }
        });
    </script>
@endpush
