<script>
    function modalAction(url = '') {
        $('#myModal .modal-content').load(url, function() {
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
                        <button type="button" class="btn btn-soft-info btn-sm" onclick="modalAction('/user/${row.id_pengguna}/show')"><i class="bx bx-show-alt"></i> Detail</button>
                        <button type="button" class="btn btn-soft-warning btn-sm" onclick="modalAction('/user/${row.id_pengguna}/edit')"><i class="bx bx-edit"></i> Edit</button>
                        <button type="button" class="btn btn-soft-danger btn-sm" onclick="modalAction('/user/${row.id_pengguna}/confirm')"><i class="bx bx-trash"></i> Hapus</button>
                        `;
                    }
                }
            ]
        });

        const state = dataUser.state.loaded();
        if (state) {
            const savedFilter = state.ajax?.id_peran_filter || '';
            $('#id_peran_filter').val(savedFilter);
        }

        $('#id_peran_filter').on('change', function() {
            dataUser.ajax.reload();
        });
    });
</script>
