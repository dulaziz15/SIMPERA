<script>
    $(document).ready(function () {
    const table = $('#table_gedung').DataTable({
        processing: true,
        serverSide: false,                
        ajax: {
            url: '{{ url("gedung/data") }}',
            type: 'GET',
            dataSrc: 'data',               
        },
        columns: [
            {
                data: null,
                className: 'text-center',
                orderable: false,
                searchable: false,
                render: (data, type, row, meta) => meta.row + 1
            },
            { data: 'kode' },
            { data: 'nama' },
            { data: 'deskripsi' },
            {
                data: null,
                className: 'text-center',
                orderable: false,
                searchable: false,
                render: (data, type, row) => `
                    <button class="btn btn-sm btn-info me-1"  onclick="editGedung(${row.id_gedung})">Edit</button>
                    <button class="btn btn-sm btn-danger"     onclick="deleteGedung(${row.id_gedung})">Hapus</button>
                `
            }
        ]
    });
});
</script>