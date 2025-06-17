<div class="card">
    <div class="card-header bg-primary text-white">
        <h4 class="card-title mb-0">
            <i class="fas fa-tasks me-2"></i>Penugasan Teknisi
        </h4>
    </div>
    <div class="card-body">
        <!-- Daftar Laporan -->
        <div class="table-responsive">
            <table class="table table-hover table-striped" id="tabel-penugasan">
                <thead class="table-light">
                    <tr>
                        <th width="5%">No</th>
                        <th width="15%">Fasilitas</th>
                        <th width="20%">Pelapor</th>
                        <th width="20%">Tanggal Verifikasi</th>
                        <th width="15%">Status Penugasan</th>
                        <th width="25%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $nomor = 0;
                    @endphp
                    {{-- @dd($laporan) --}}
                    @foreach ($laporan as $index => $item)
                        @if ($item->status->value == \App\Enums\Status\StatusLaporanPerbaikan::PERBAIKAN->value)
                            @php
                                $nomor++;
                            @endphp
                            <tr>
                                <td>{{ $nomor }}</td>
                                <td>{{ $item->fasilitas->nama }}</td>
                                <td>{{ $item->pengguna->profil->nama_lengkap }}</td>
                                <td>{{ $item->waktu_perubahan }}</td>
                                <td><span
                                        class="badge bg-warning">{{ $item->status->label() }}</span>
                                </td>
                                <td>
                                    <a href="{{ url('/penugasan/' . $item->id_laporan . '/detail') }}"
                                        class="btn btn-sm btn-primary btn-detail">
                                        <i class="fas fa-eye me-1"></i>Detail
                                    </a>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header bg-primary text-white">
        <h4 class="card-title mb-0">
            <i class="fas fa-tasks me-2"></i>laporan yang belum dilakukan penugasan
        </h4>
    </div>
    <div class="card-body">
        <!-- Daftar Laporan -->
        <div class="table-responsive">
            <table class="table table-hover table-striped" id="tabel-belum-penugasan">
                <thead class="table-light">
                    <tr>
                        <th width="5%">No</th>
                        <th width="15%">Fasilitas</th>
                        <th width="20%">Pelapor</th>
                        <th width="20%">Tanggal Verifikasi</th>
                        <th width="15%">Status Laporan</th>
                        <th width="25%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $urutan = 0;
                    @endphp
                    {{-- @dd($laporan) --}}
                    @foreach ($laporan as $index => $item)
                        @if ($item->status->value != \App\Enums\Status\StatusLaporanPerbaikan::PERBAIKAN->value)
                            @php
                                $urutan++;
                            @endphp
                            <tr>
                                <td>{{ $urutan }}</td>
                                <td>{{ $item->fasilitas->nama }}</td>
                                <td>{{ $item->pengguna->profil->nama_lengkap }}</td>
                                <td>{{ $item->waktu_perubahan }}</td>
                                <td><span
                                        class="badge bg-{{ $item->status->color() }}">{{ $item->status->label() }}</span>
                                </td>
                                <td>
                                    <a href="{{ url('/penugasan/' . $item->id_laporan . '/detail') }}"
                                        class="btn btn-sm btn-primary btn-detail">
                                        <i class="fas fa-eye me-1"></i>Detail
                                    </a>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#tabel-penugasan').DataTable({
                ordering: true,
                searching: true
            });

            $('#tabel-belum-penugasan').DataTable({
                ordering: true,
                searching: true
            });
        });
    </script>
@endpush