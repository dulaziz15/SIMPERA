<script>
    function modalAction(url = '') {
        $('#myModal').load(url, function() {
            $('#myModal').modal('show');
        });
    }

    var dataPelaporan;
    $(document).ready(function() {
        dataPelaporan = $('#table_pelaporan_peninjauan').DataTable({
            processing: true,
            serverSide: true,
            stateSave: true,
            ajax: {
                url: "{{ url('pelaporan/data') }}?tipe=pelaporan",
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
                    data: "status.value",
                    render: function(data, type, row) {
                        const statusMap = {
                            'baru': {
                                color: 'primary',
                                label: 'Baru'
                            },
                            'diverifikasi': {
                                color: 'info',
                                label: 'Diverifikasi'
                            },
                            'diperbaiki': {
                                color: 'warning',
                                label: 'Sedang Diperbaiki'
                            },
                            'ditolak': {
                                color: 'danger',
                                label: 'Ditolak'
                            },
                            'selesai': {
                                color: 'success',
                                label: 'Selesai'
                            }
                        };

                        const status = statusMap[data] || {
                            color: 'secondary',
                            icon: 'fa-question',
                            label: data
                        };

                        return `
                            <span class="badge bg-${status.color} bg-opacity-15 text-white
                                border border-${status.color} border-opacity-25">
                                ${status.label}
                            </span>
                        `;
                    }
                },
                {
                    data: "periode.nama"
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return moment(row.waktu_pelaporan).format('D MMM YYYY');
                    }
                },
                {
                    data: "perkiraan_biaya"
                },
                {
                    data: 'kerusakan',
                    render: function(data, type, row) {
                        const statusMap = {
                            '1': {
                                color: 'primary',
                                label: 'Ringan'
                            },
                            '2': {
                                color: 'warning',
                                label: 'Sedang'
                            },
                            '3': {
                                color: 'danger',
                                label: 'Berat'
                            },
                        };

                        const status = statusMap[data] || {
                            color: 'secondary',
                            icon: 'fa-question',
                            label: data
                        };

                        return `
                            <span class="badge bg-${status.color} bg-opacity-15 text-white
                                border border-${status.color} border-opacity-25">
                                ${status.label}
                            </span>
                        `;
                    }
                },
                {
                    data: null,
                    orderable: false,
                    searchable: false,
                    className: 'text-center p-2',
                    render: function(data, type, row) {
                        return `
                        <button type="button" class="btn btn-soft-warning btn-sm" onclick="modalAction('/pelaporan/${row.id_laporan}/peninjauan/edit')"><i class="bx bx-edit"></i> Edit Peninjauan</button>
                    `;
                    }
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

    var dataPelaporanPeninjauan;
    $(document).ready(function() {
        dataPelaporanPeninjauan = $('#table_pelaporan').DataTable({
            processing: true,
            serverSide: true,
            stateSave: true,
            ajax: {
                url: "{{ url('pelaporan/data') }}?tipe=peninjauan",
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
                    data: "status.value",
                    render: function(data, type, row) {
                        const statusMap = {
                            'baru': {
                                color: 'primary',
                                label: 'Baru'
                            },
                            'diverifikasi': {
                                color: 'info',
                                label: 'Diverifikasi'
                            },
                            'diperbaiki': {
                                color: 'warning',
                                label: 'Sedang Diperbaiki'
                            },
                            'ditolak': {
                                color: 'danger',
                                label: 'Ditolak'
                            },
                            'selesai': {
                                color: 'success',
                                label: 'Selesai'
                            }
                        };

                        const status = statusMap[data] || {
                            color: 'secondary',
                            icon: 'fa-question',
                            label: data
                        };

                        return `
                            <span class="badge bg-${status.color} bg-opacity-15 text-white
                                border border-${status.color} border-opacity-25">
                                ${status.label}
                            </span>
                        `;
                    }
                },
                {
                    data: "periode.nama"
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return moment(row.waktu_pelaporan).format('D MMM YYYY');
                    }
                },
                {
                    data: null,
                    orderable: false,
                    searchable: false,
                    className: 'text-center p-2',
                    render: function(data, type, row) {
                        return `
                        <button type="button" class="btn btn-soft-info btn-sm" onclick="modalAction('/pelaporan/${row.id_laporan}/peninjauan')"><i class="bx bx-show-alt"></i> Peninjauan</button>
                    `;
                    }
                }
            ]
        });
    });

</script>
