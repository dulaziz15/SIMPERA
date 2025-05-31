@extends('layout.app')

@section('content')
    <div class="row">
        <div class="col-lg-6 col-12">
            <h1>Periode</h1>
            <div class="col-lg-6 col-12 mt-4 mt-lg-0">
                <form action="{{ url('periode/' . $periode->id_periode . '/delete') }}" method="POST" id='form-delete'>
                    @csrf
                    @method('DELETE')
                    <div class="alert alert-warning">
                        <h5><i class="icon fas fa-ban"></i> Konfirmasi !!!</h5>
                        Apakah Anda ingin menghapus data seperti di bawah ini?
                    </div>
                    <table class="table table-sm table-bordered table-striped">
                        <tr>
                            <th class="text-right col-3">Nama :</th>
                            <td class="col-9">{{ $periode->nama }}</td>
                        </tr>

                        <tr>
                            <th class="text-right col-3">Tanggal Mulai :</th>
                            <td class="col-9">{{ $periode->tanggal_mulai }}</td>
                        </tr>

                        <tr>
                            <th class="text-right col-3">Tanggal Selesai :</th>
                            <td class="col-9">{{ $periode->tanggal_selesai }}</td>
                        </tr>
                        <button type="submit">Delete</button>
                </form>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                $('#form-delete').on('submit', function(e) {
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
