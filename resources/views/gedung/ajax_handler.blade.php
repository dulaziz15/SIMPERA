<script>
	function modalAction(url = '') {
		$('#myModal').load(url, function() {
			$('#myModal').modal('show');
		});
	}

	var gedungData;
	var kategoriGedungData;
	var ruanganData;
	$(document).ready(function() {
		gedungData = $('#table_gedung').DataTable({
			dom: '<"row mb-3"<"col-md-6"B><"col-md-6"f>>' +
                '<"row"<"col-sm-12"tr>>' +
                '<"row mt-3"<"col-md-6"i><"col-md-6"p>>',
			buttons: [{
					extend: 'pdfHtml5',
					text: '<i class="bx bx-download"></i> Download PDF',
					className: 'btn btn-soft-primary btn-md',
					title: 'Data Gedung',
					download: 'open',
					exportOptions: {
						columns: ':visible:not(:last-child)' // Exclude action column
					}
				},
				{
					extend: 'excelHtml5',
					text: '<i class="bx bx-file"></i> Export to Excel',
					className: 'btn btn-soft-success btn-md',
					title: 'Data Gedung',
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
				url: '{{ url('gedung/data') }}',
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
			dom: '<"row mb-3"<"col-md-6"B><"col-md-6"f>>' +
                '<"row"<"col-sm-12"tr>>' +
                '<"row mt-3"<"col-md-6"i><"col-md-6"p>>',
			buttons: [{
					extend: 'pdfHtml5',
					text: '<i class="bx bx-download"></i> Download PDF',
					className: 'btn btn-soft-primary btn-md',
					title: 'Data Kategori Gedung',
					download: 'open',
					exportOptions: {
						columns: ':visible:not(:last-child)' // Exclude action column
					}
				},
				{
					extend: 'excelHtml5',
					text: '<i class="bx bx-file"></i> Export to Excel',
					className: 'btn btn-soft-success btn-md',
					title: 'Data Kategori Gedung',
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

		ruanganData = $('#table_ruangan').DataTable({
			dom: '<"row mb-3"<"col-md-6"B><"col-md-6"f>>' +
                '<"row"<"col-sm-12"tr>>' +
                '<"row mt-3"<"col-md-6"i><"col-md-6"p>>',
			buttons: [{
					extend: 'pdfHtml5',
					text: '<i class="bx bx-download"></i> Download PDF',
					className: 'btn btn-soft-primary btn-md',
					title: 'Data Ruangan',
					download: 'open',
					exportOptions: {
						columns: ':visible:not(:last-child)' // Exclude action column
					}
				},
				{
					extend: 'excelHtml5',
					text: '<i class="bx bx-file"></i> Export to Excel',
					className: 'btn btn-soft-success btn-md',
					title: 'Data Ruangan',
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
				url: '{{ url('ruangan/data') }}',
				type: 'POST',
				dataSrc: 'data',
				data: function(d) {
					d.id_gedung = $('#id_gedung_filter').val();
				}
			},
			columns: [{
					data: null,
					className: 'text-center',
					orderable: false,
					searchable: false,
					render: (data, type, row, meta) => meta.row + 1
				},
				{
					data: 'kode'
				},
				{
					data: 'nama'
				},
				{
					data: 'lantai'
				},
				{
					data: 'gedung.nama'
				},
				{
					data: 'deskripsi'
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

		// filter ruangan by gedung
		const stateRuangan = ruanganData.state.loaded();
		if (stateRuangan) {
			const savedFilter = stateRuangan.ajax?.id_gedung_filter || '';
			$('#id_gedung_filter').val(savedFilter);
		}

		$('#id_gedung_filter').on('change', function() {
			ruanganData.ajax.reload();
		});
	});
</script>
