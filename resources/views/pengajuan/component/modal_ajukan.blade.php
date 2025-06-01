<div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Confirm Ajukan</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-center">
            <h6> {{ $item->fasilitas->nama }} </h6>
        </div>
        <form id="form-ajukan" method="post" action="{{ url('/pengajuan/' . $item->id_laporan . '/ajukan') }}">
            @csrf
            <button class="btn btn-success" type="submit">Ajukan</button>
        </form>
    </div>
</div>
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#form-ajukan').on('submit', function(e) {
                e.preventDefault();

                var form = $(this);
                var formData = form.serialize();

                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    data: formData,
                    dataType: 'json', 
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest', 
                        'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                        'Accept': 'application/json'
                    },
                    success: function(response) {
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
                        if (xhr.status === 302) {
                            window.location.href = '/pengajuan';
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Terjadi kesalahan pada server'
                            });
                        }
                    }
                });
            });
        });
    </script>
@endpush
