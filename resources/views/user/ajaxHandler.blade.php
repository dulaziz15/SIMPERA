<script>
    function modalAction(url = '') {
        $('#myModal').load(url, function() {
            $('#myModal').modal('show');
        });
    }



    var dataUser;
    $(document).ready(function() {
        dataUser = $('#table_user').DataTable({
            processing: true,
            serverSide: true,
            stateSave: true,
            ajax: {
                url: "{{ url('user/data') }}",
                type: 'POST',
                data: function(d) {
                    d.id_peran = $('#id_peran_filter').val();
                }
            },
            columns: [{
                    data: null,
                    className: 'text-center',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: "nama_pengguna"
                },
                {
                    data: "surel"
                },
                {
                    data: "peran.nama"
                },
                {
                    data: null,
                    orderable: false,
                    searchable: false,
                    className: 'text-center p-2',
                    render: function(data, type, row) {
                        return `
                            <button type="button" class="btn btn-soft-primary waves-effect waves-light btn-sm" onclick="modalAction('{{ url('user/${row.id_pengguna}/show') }}')"><i class="bx bx-show-alt font-size-16 align-middle"></i> Edit</button>
                            <button type="button" class="btn btn-soft-warning waves-effect waves-light btn-sm" onclick="modalAction('{{ url('user/${row.id_pengguna}/edit') }}')"><i class="bx bx-edit font-size-16 align-middle"></i> Edit</button>
                            <button type="button" class="btn btn-soft-danger waves-effect waves-light btn-sm" onclick="modalAction('{{ url('user/${row.id_pengguna}/confirm') }}')"><i class="bx bx-trash font-size-16 align-middle"></i> hapus</button>
                        `;
                    }
                }
            ]
        });

        const state = dataUser.state.loaded();
        if (state) {
            const savedFilter = state.ajax?.id_peran || '';
            $('#id_peran').val(savedFilter);
        }

        $('#id_peran').on('change', function() {
            dataUser.ajax.reload();
        });
    });

    function hapusData(id) {
        if (confirm('Yakin ingin menghapus user ini?')) {
            $.ajax({
                url: `/user/delete/${id}`,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $('#table_user').DataTable().ajax.reload();
                    alert('Data berhasil dihapus!');
                },
                error: function() {
                    alert('Terjadi kesalahan saat menghapus data.');
                }
            });
        }
    }
</script>
