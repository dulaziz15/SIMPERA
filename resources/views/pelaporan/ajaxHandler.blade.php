<script>
    function modalAction(url = '') {
        $('#myModal').load(url, function() {
            $('#myModal').modal('show');
        });
    }

    var dataPelaporan;
    $(document).ready(function() {
        dataPelaporan = $('#table_pelaporan').DataTable({
            processing: true,
            serverSide: true,
            stateSave: true,
            ajax: {
                url: "{{ url('pelaporan/data') }}",
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
                    data: "pengguna.nama_pengguna"
                },
                {
                    data: "fasilitas.nama"
                },
                {
                    data: "status"
                },
                {
                    data: "periode.nama"
                },
                {
                    data: "waktu_pelaporan"
                },
                {
                    data: null,
                    orderable: false,
                    searchable: false,
                    className: 'text-center p-2',
                    render: function(data, type, row) {
                         return `
                        <a href="{{ url('/pelaporan/${row.id_laporan}/show') }}" class="btn btn-soft-info btn-sm"><i class="bx bx-show-alt"></i> Detail</a>
                        <button type="button" class="btn btn-soft-warning btn-sm" onclick="modalAction('/pelaporan/${row.id_laporan}/edit')"><i class="bx bx-edit"></i> Edit</button>
                        <button type="button" class="btn btn-soft-danger btn-sm" onclick="modalAction('/pelaporan/${row.id_laporan}/confirm')"><i class="bx bx-trash"></i> Hapus</button>
                    `;
                    }
                }
            ]
        });
    });
</script>
