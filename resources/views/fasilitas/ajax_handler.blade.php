<script>
    var fasilitasData;
    $(document).ready(function() {
        fasilitasData = $('#table_fasilitas').DataTable({
            processing: true,
            serverSide: true,
            stateSave: true,
            ajax: {
                url: '{{ url("fasilitas/data") }}',
                type: 'GET',
                dataSrc: 'data',
            },
            columns: [{
                    data: null,
                    className: 'text-center',
                    orderable: false,
                    searchable: false,
                    render: (data, type, row, meta) => meta.row + 1
                },
                {
                    data: 'nama'
                },
                {
                    data: 'kategori.nama'
                },
                {
                    data: 'ruangan.nama'
                },
                {
                    data: 'ruangan.gedung.nama'
                },
                {
                    data: 'status',
                    className: 'text-center',
                    render: function(data, type, row) {
                        return `<span class="badge bg-primary">${row.status}</span>`
                    }
                },
                {
                    data: null,
                    className: 'text-center',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return `
                            <button type="button" class="btn btn-soft-info waves-effect waves-light btn-sm" onclick="modalAction('{{ url('ruangan/${row.id_ruangan}/show') }}')" ><i class="bx bx-show-alt font-size-16 align-middle"></i> Show</button>
                            <button type="button" class="btn btn-soft-warning waves-effect waves-light btn-sm" onclick="modalAction('{{ url('ruangan/${row.id_ruangan}/edit') }}')"><i class="bx bx-edit font-size-16 align-middle"></i> Edit</button>
                            <button type="button" class="btn btn-soft-danger waves-effect waves-light btn-sm" onclick="modalAction('{{ url('ruangan/${row.id_ruangan}/confirm') }}')"><i class="bx bx-trash font-size-16 align-middle"></i> hapus</button>
                        `
                    }
                }
            ]
        });
    });
</script>
