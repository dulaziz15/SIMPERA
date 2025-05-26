<script>
    $(document).ready(function() {
        // Inisialisasi DataTable untuk tabel kegiatan UKM
        var dataUser = $('#table_periode').DataTable({
            serverSide: true, // Data diolah di server
            processing: true, // Menampilkan animasi loading saat memproses data
            ajax: {
                "url": "{{ url('perode/show') }}", // URL untuk mengambil data
                "dataType": "json",
                "type": "POST",
                "data": function(d){
                    d._token = "{{ csrf_token() }}"; // Token CSRF untuk keamanan
                    d.id_periode = $("#id_periode").val(); // Kirim data filter UKM
                }
            },
            columns: [
                {
                    data: "DT_RowIndex", // Index baris (otomatis)
                    className: "text-center",
                    orderable: false,
                    searchable: false
                },{
                    data: "nama_kegiatan", // Kolom untuk nama kegiatan
                    className: "",
                    orderable: false,
                    searchable: false
                },{
                    data: "ukm.nama", // Kolom untuk nama UKM
                    className: "",
                    orderable: true,
                    searchable: true
                },{
                    data: "aksi", // Kolom untuk aksi (edit, hapus)
                    className: "",
                    orderable: false,
                    searchable: false
                }
            ]
        });
        
        // Reload table saat filter UKM berubah
        $("#ukm_id").on("change", function() {
            dataUser.ajax.reload();
        });
    });
    
    // Jika ada session success, tampilkan notifikasi berhasil
    @if (session('success'))
    Swal.fire({
        icon: 'success',
        title: 'Data berhasil diperbarui!',
        text: '{{ session('success') }}',
        showConfirmButton: true
    });
    @endif
</script>