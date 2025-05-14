@extends('layout.app')

@section('content')
    <div class="row">
        <div class="col-lg-6 col-12">
            <h1>Periode</h1>
            <div class="col-lg-6 col-12 mt-4 mt-lg-0">
                <form action="{{ url('periode/store') }}" method="POST" id='form-create'>
                    @csrf
                    <input type="text" name="nama" id="nama">
                    <span class="text-danger error-text" id="error-nama"></span>

                    <input type="date" name="tanggal_mulai" id="tanggal_mulai">
                    <span class="text-danger error-text" id="error-tanggal_mulai"></span>

                    <input type="date" name="tanggal_selesai" id="tanggal_selesai">
                    <span class="text-danger error-text" id="error-tanggal_selesai"></span>

                    <button type="submit">Simpan</button>
                </form>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                $('#form-create').on('submit', function(e) {
                    e.preventDefault(); 
                    let form = this;

                    $('.error-text').text('');

                    $.ajax({
                        url: form.action,
                        method: form.method,
                        data: $(form).serialize(),
                        dataType: 'json',
                        headers: {
                            'Accept': 'application/json' 
                        },
                        success: function(response) {
                            if (response.status) {
                                $('#myModal').modal('hide');
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: response.message
                                });
                                // Reload datatable atau redirect jika perlu
                            } else {
                                $.each(response.msgField, function(key, val) {
                                    $('#error-' + key).text(val[0]);
                                });
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Validasi Gagal',
                                    text: response.message
                                });
                            }
                        },
                        error: function(xhr) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Terjadi Kesalahan',
                                text: 'Coba lagi nanti atau hubungi admin.'
                            });
                            console.error(xhr.responseText);
                        }
                    });
                });
            });
        </script>
    @endsection
