<script>
	function modalAction(url = '') {
		$('#myModal').load(url, function() {
			$('#myModal').modal('show');
		});
	}

	function modalProfil(url = '') {
		$('#modalProfil').load(url, function() {
			$('#modalProfil').modal('show');
		});
	}

	var dataUser;
	$(document).ready(function() {
		dataUser = $('#table_user').DataTable({
			dom: 'B<"d-flex justify-content-between align-items-center mt-4"lf>',
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

		// Tambahkan baris ini untuk menampilkan tombol export
		dataUser.buttons().container().appendTo('#table_user_wrapper .col-md-6:eq(0)');

		$(".dataTables_length select").addClass("form-select form-select-sm");

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
