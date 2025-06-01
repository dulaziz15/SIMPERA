<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="confirmModalLabel">Konfirmasi</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <p id="confirmMessage">Apakah Anda yakin ingin memverifikasi laporan ini?</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="button" class="btn btn-primary" id="confirmButton">Ya, Verifikasi</button>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        $('#confirmButton').click(function() {
            if (currentLaporanId) {
                $.ajax({
                    url: "{{ url('pengajuan') }}/" + currentLaporanId + "/verifikasi",
                    type: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                        'Accept': 'application/json'
                    },
                    success: function(response) {
                        $('#confirmModal').modal('hide');
                        if (response.status) {
                            $('#myModal').modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.message,
                                timer: 1000,
                                showConfirmButton: false
                            }).then(function() {
                                window.location.href = response.redirect;
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: response.message
                            }).then(function() {
                                window.location.href = response.redirect;
                            });
                        }
                    },
                    error: function(xhr) {
                        $('#confirmModal').modal('hide');
                        showErrorAlert(xhr.responseJSON?.message || 'Terjadi kesalahan server');
                    }
                });
            }
        });
    </script>
@endpush
