<script>
    function modalAction(url = '') {
        $('#myModal').load(url, function() {
            $('#myModal').modal('show');
        });
    }

    var dataPeran;
    $(document).ready(function() {
        dataPeran = $('#table_peran').DataTable({
            processing: true,
            serverSide: true,
            stateSave: true,
            ajax: {
                url: "{{ url('peran/data') }}",
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
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
                    data: "nama"
                },
                {
                    data: "kode_peran"
                },
                {
                    data: null,
                    orderable: false,
                    searchable: false,
                    className: 'text-center p-2',
                    render: function(data, type, row) {
                         return `
                        <button type="button" class="btn btn-soft-info btn-sm" onclick="modalAction('/peran/${row.id_peran}/show')"><i class="bx bx-show-alt"></i> Detail</button>
                        <button type="button" class="btn btn-soft-warning btn-sm" onclick="modalAction('/peran/${row.id_peran}/edit')"><i class="bx bx-edit"></i> Edit</button>
                        <button type="button" class="btn btn-soft-danger btn-sm" onclick="modalAction('/peran/${row.id_peran}/confirm')"><i class="bx bx-trash"></i> Hapus</button>
                    `;
                    }
                }
            ]
        });
    });
</script>
