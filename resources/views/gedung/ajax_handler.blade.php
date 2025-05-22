<script>
    function modalAction(url = '') {
        $('#myModal').load(url, function() {
            $('#myModal').modal('show');
        });
    }

    var gedungData;
    var kategoriGedungData;
    $(document).ready(function() {
        gedungData = $('#table_gedung').DataTable({
            processing: true,
            serverSide: true,
            stateSave: true,
            ajax: {
                url: '{{ url("gedung/data") }}',
                type: 'POST',
                dataSrc: 'data',
                data: function(d) {
                    d.id_kategori_gedung = $('#id_kategori_gedung_filter').val();
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
                    data: 'kode'
                },
                {
                    data: 'nama'
                },
                {
                    data: 'deskripsi'
                },
                {
                    data: 'kategori_gedung.kategori_gedung'
                },
                {
                    data: null,
                    className: 'text-center',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return `
                            <button type="button" class="btn btn-soft-info waves-effect waves-light btn-sm" onclick="modalAction('{{ url('gedung/${row.id_gedung}/show') }}')" ><i class="bx bx-show-alt font-size-16 align-middle"></i> Show</button>
                            <button type="button" class="btn btn-soft-warning waves-effect waves-light btn-sm" onclick="modalAction('{{ url('gedung/${row.id_gedung}/edit') }}')"><i class="bx bx-edit font-size-16 align-middle"></i> Edit</button>
                            <button type="button" class="btn btn-soft-danger waves-effect waves-light btn-sm" onclick="modalAction('{{ url('gedung/${row.id_gedung}/confirm') }}')"><i class="bx bx-trash font-size-16 align-middle"></i> hapus</button>
                        `;
                    }

                }
            ]
        });

        kategoriGedungData = $('#table_kategori_gedung').DataTable({
            processing: true,
            serverSide: false,
            ajax: {
                url: '{{ url('kategori_gedung/data') }}',
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
                    data: 'kategori_gedung'
                },
                {
                    data: null,
                    className: 'text-center',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return `
                            <button type="button" class="btn btn-soft-info waves-effect waves-light btn-sm" onclick="modalAction('{{ url('kategori_gedung/${row.id_kategori_gedung}/show') }}')" ><i class="bx bx-show-alt font-size-16 align-middle"></i> Show</button>
                            <button type="button" class="btn btn-soft-warning waves-effect waves-light btn-sm" onclick="modalAction('{{ url('kategori_gedung/${row.id_kategori_gedung}/edit') }}')"><i class="bx bx-edit font-size-16 align-middle"></i> Edit</button>
                            <button type="button" class="btn btn-soft-danger waves-effect waves-light btn-sm" onclick="modalAction('{{ url('kategori_gedung/${row.id_kategori_gedung}/confirm') }}')"><i class="bx bx-trash font-size-16 align-middle"></i> hapus</button>
                        `;
                    }

                }
            ]
        });

        // filter gedung by kategori
        const state = gedungData.state.loaded();
        if (state) {
            const savedFilter = state.ajax?.id_kategori_gedung_filter || '';
            $('#id_kategori_gedung_filter').val(savedFilter);
        }

        $('#id_kategori_gedung_filter').on('change', function() {
            gedungData.ajax.reload();
        });
    });
</script>
