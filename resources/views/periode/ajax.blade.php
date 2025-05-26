<script>
    $(document).ready(function() {
        const periodeDropdown = $('#dropdownMenuClickableInside');
        const tableContainer = $('#table_periode').closest('.card-body');
        let dataTable = null;

        tableContainer.hide();

        function loadPeriodeOptions() {
            $.ajax({
                "url": "{{ url('periode/') }}",
                "method": 'GET',
                "dataType": 'json',
                success: function(response) {
                    periodeDropdown.empty();
                    periodeDropdown.append('<option value="">-- Pilih Periode --</option>');

                    $.each(response.data, function(index, periode) {
                        periodeDropdown.append(`<option value="${periode.id}">${periode.nama_periode}</option>`);
                    });
                },
                error: function(xhr) {
                    console.error('Error loading periode options:', xhr.responseText);
                    toastr.error('Gagal memuat data periode');
                }
            });
        }

        function initializeDataTable(periodeId) {
            if (dataTable) {
                dataTable.destroy();
            }

            dataTable = $('#table_periode').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    "url": '', 
                    "data": { periode_id: periodeId },
                    error: function(xhr) {
                        console.error('Error loading table data:', xhr.responseText);
                        toastr.error('Gagal memuat data fasilitas');
                    }
                },
                columns: [
                    { 
                        data: 'DT_RowIndex', 
                        name: 'DT_RowIndex', 
                        orderable: false, 
                        searchable: false 
                    },{ 
                        data: 'nama_fasilitas', 
                        name: 'nama_fasilitas' 
                    },{ 
                        data: 'status', 
                        name: 'status',
                        render: function(data) {
                            const badgeClass = data === 'Aktif' ? 'badge bg-success' : 'badge bg-danger';
                            return `<span class="${badgeClass}">${data}</span>`;
                        }
                    },{
                        data: 'aksi',
                        name: 'aksi',
                        orderable: false,
                        searchable: false,
                        render: function(data) {
                            return `
                                <button class="btn btn-sm btn-primary">Detail</button>
                                <button class="btn btn-sm btn-warning">Edit</button>
                            `;
                        }
                    }
                ],
                responsive: true,
                autoWidth: false,
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json'
                }
            });
        }

        periodeDropdown.on('change', function() {
            const selectedPeriode = $(this).val();

            if (selectedPeriode) {
                tableContainer.show();

                initializeDataTable(selectedPeriode);
            } else {
                tableContainer.hide();

                if (dataTable) {
                    dataTable.destroy();
                    dataTable = null;
                }
            }
        });

        loadPeriodeOptions();
    });
</script>