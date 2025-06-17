<script>
	function modalAction(url = '') {
		$('#myModal').load(url, function() {
			$('#myModal').modal('show');
		});
	}

	var dataPeran;
	$(document).ready(function() {
		dataPeran = $('#table_peran').DataTable({
			dom: '<"row mb-3"<"col-md-6"B><"col-md-6"f>>' +
                '<"row"<"col-sm-12"tr>>' +
                '<"row mt-3"<"col-md-6"i><"col-md-6"p>>',
			buttons: [{
					extend: 'pdfHtml5',
					text: '<i class="bx bx-download"></i> Download PDF',
					className: 'btn btn-soft-primary btn-md',
					title: 'Data Peran',
					download: 'open',
					exportOptions: {
						columns: ':visible:not(:last-child)' // Exclude action column
					}
				},
				{
					extend: 'excelHtml5',
					text: '<i class="bx bx-file"></i> Export to Excel',
					className: 'btn btn-soft-success btn-md',
					title: 'Data Peran',
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
