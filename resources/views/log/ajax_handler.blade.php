<script>
    var dataLog;
    $(document).ready(function() {
        dataLog = $('#table_log').DataTable({
            dom: '<"row mb-3"<"col-md-6"B><"col-md-6"f>>' +
                '<"row"<"col-sm-12"tr>>' +
                '<"row mt-3"<"col-md-6"i><"col-md-6"p>>',
            buttons: [{
                    extend: 'pdfHtml5',
                    text: '<i class="bx bx-download"></i> Download PDF',
                    className: 'btn btn-soft-primary btn-md',
                    title: 'Data User',
                    download: 'open',
                    exportOptions: {
                        columns: ':visible:not(:last-child)' // Exclude action column
                    }
                },
                {
                    extend: 'excelHtml5',
                    text: '<i class="bx bx-file"></i> Export to Excel',
                    className: 'btn btn-soft-success btn-md',
                    title: 'Data User',
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
            processing: true,
            serverSide: true,
            stateSave: true,
            ajax: {
                url: "{{ url('log/data') }}",
                type: 'GET',
                dataSrc: function(json) {
                    console.log(json); // debug output dari server
                    return json.data;
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
                    data: "pengguna.nama_pengguna",
                },
                {
                    data: "jenis_aktivitas",
                },
                {
                    data: "deskripsi",
                },
                {
                    data: "waktu",
                }
            ]
        });

        // Tambahkan baris ini untuk menampilkan tombol export
        dataLog.buttons().container().appendTo('#table_user_wrapper .col-md-6:eq(0)');

        $(".dataTables_length select").addClass("form-select form-select-sm");

        const state = dataLog.state.loaded();
        if (state) {
            const savedFilter = state.ajax?.id_peran_filter || '';
            $('#id_peran_filter').val(savedFilter);
        }

        $('#id_peran_filter').on('change', function() {
            dataLog.ajax.reload();
        });
    });
</script>
