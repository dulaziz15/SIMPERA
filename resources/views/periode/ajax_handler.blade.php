<script>
    function modalAction(url = '') {
        $('#myModal').load(url, function() {
            $('#myModal').modal('show');
        });
    }

    var periodeData;
    $(document).ready(function() {
        periodeData = $('#table_periode').DataTable({
            dom: '<"row mb-3"<"col-md-6"B><"col-md-6"f>>' +
                '<"row"<"col-sm-12"tr>>' +
                '<"row mt-3"<"col-md-6"i><"col-md-6"p>>',
            buttons: [{
                    extend: 'pdfHtml5',
                    text: '<i class="bx bx-download"></i> Download PDF',
                    className: 'btn btn-soft-primary btn-md',
                    title: 'Data Kategori Fasilitas',
                    download: 'open',
                    exportOptions: {
                        columns: ':visible:not(:last-child)' // Exclude action column
                    }
                },
                {
                    extend: 'excelHtml5',
                    text: '<i class="bx bx-file"></i> Export to Excel',
                    className: 'btn btn-soft-success btn-md',
                    title: 'Data Kategori Fasilitas',
                    download: 'open',
                    exportOptions: {
                        columns: ':visible:not(:last-child)' // Exclude action column
                    }
                },
                {
                    extend: 'colvis',
                    text: '<i class="bx bx-columns"></i> Column Visibility',
                    className: 'btn btn-soft-secondary btn-md'
                }
            ],
            responsive: true,
            ordering: true, // make sure ordering is enabled
            paging: true, // enable pagination
            lengthChange: true, // show 'Show entries' dropdown
            info: true, // show info text below table
            processing: false,
            serverSide: false,
            stateSave: false,
            ajax: {
                url: '{{ url('periode/data') }}',
                type: 'GET',
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
                    data: 'biaya',
                    render: (data) => data ?? '-'
                },
                {
                    data: 'tanggal_mulai'
                },
                {
                    data: 'tanggal_selesai'
                },
                {
                    data: null,
                    className: 'text-center',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return `
                            <button type="button" class="btn btn-soft-info waves-effect waves-light btn-sm" onclick="modalAction('{{ url('periode/${row.id_periode}/show') }}')" ><i class="bx bx-show-alt font-size-16 align-middle"></i> Show</button>
                            <button type="button" class="btn btn-soft-warning waves-effect waves-light btn-sm" onclick="modalAction('{{ url('periode/${row.id_periode}/edit') }}')"><i class="bx bx-edit font-size-16 align-middle"></i> Edit</button>
                            <button type="button" class="btn btn-soft-danger waves-effect waves-light btn-sm" onclick="modalAction('{{ url('periode/${row.id_periode}/confirm') }}')"><i class="bx bx-trash font-size-16 align-middle"></i> hapus</button>
                        `
                    }
                }
            ]
        });
    });
</script>
