@extends('layout.print')

@section('content')
    <div class="print-header mb-4">
        <div class="row align-items-center text-center">
            <div class="col-2 text-start">
                <img src="{{ asset('template/assets/images/polinema.png') }}" alt="Logo Polinema" width="100">
            </div>
            <div class="col-10 text-start">
                <h2 class="mb-1">Laporan Sistem Pelaporan Fasilitas</h2>
                <p class="text-muted mb-1">
                    Periode:
                    {{ request('start_date') ? date('d M Y', strtotime(request('start_date'))) : date('d M Y', strtotime($periode->tanggal_mulai)) }}
                    -
                    {{ request('end_date') ? date('d M Y', strtotime(request('end_date'))) : date('d M Y', strtotime($periode->tanggal_selesai)) }}
                </p>
                <p class="text-muted mb-0">Dicetak pada: {{ now()->format('d M Y H:i:s') }}</p>
            </div>
        </div>
        </div>
        <hr class="mb-5">
    <div class="print-section mb-4">
        <h4 class="section-title">Ringkasan Statistik</h4>
        <div class="row">
            <div class="col-3">
                <div class="stat-card">
                    <div class="stat-title">Jumlah User</div>
                    <div class="stat-value">{{ $user->count() }}</div>
                    <div class="stat-desc">Jumlah User Pada Sistem</div>
                </div>
            </div>
            <div class="col-3">
                <div class="stat-card">
                    <div class="stat-title">Jumlah Laporan</div>
                    <div class="stat-value">{{ $laporan->count() }}</div>
                    <div class="stat-desc">Jumlah Laporan yang dibuat</div>
                </div>
            </div>
            <div class="col-3">
                <div class="stat-card">
                    <div class="stat-title">Biaya Perbaikan</div>
                    <div class="stat-value">Rp. {{ $totalBiaya }}</div>
                    <div class="stat-desc">Total pengeluaran perbaikan</div>
                </div>
            </div>
            <div class="col-3">
                <div class="stat-card">
                    <div class="stat-title">Jumlah Fasilitas</div>
                    <div class="stat-value">{{ $fasilitas->count() }}</div>
                    <div class="stat-desc">Fasilitas dalam sistem</div>
                </div>
            </div>
        </div>
    </div>

    <div class="print-section mb-4">
        <h4 class="section-title">Perkiraan Biaya Perbaikan Tertinggi</h4>
        <table class="print-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Fasilitas</th>
                    <th>Lokasi</th>
                    <th>Status</th>
                    <th>Perkiraan Biaya</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($perkiraanBiayaPerbaikan->take(5) as $i => $item)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $item['fasilitas']->nama }}</td>
                        <td>
                            {{ $item['fasilitas']->ruangan->nama }} -
                            {{ $item['fasilitas']->ruangan->gedung->nama }}
                        </td>
                        <td>{{ $item->status->label() }}</td>
                        <td>Rp. {{ number_format($item['perkiraan_biaya'], 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="print-section mb-4">
        <h4 class="section-title">Fasilitas Sering Dilaporkan</h4>
        <table class="print-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Fasilitas</th>
                    <th>Lokasi</th>
                    <th>Status</th>
                    <th>Jumlah Laporan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($fasilitasSeringDilaporkan->take(5) as $i => $item)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $item['fasilitas']->nama }}</td>
                        <td>
                            {{ $item['fasilitas']->ruangan->nama }} -
                            {{ $item['fasilitas']->ruangan->gedung->nama }}
                        </td>
                        <td>{{ $item['fasilitas']->laporan->status }}</td>
                        <td>{{ $item['total'] }} Pelapor</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="print-section mb-4">
        <h4 class="section-title">Distribusi Data</h4>
        <div class="row">
            <div class="col-4">
                <h5>Data User</h5>
                <table class="print-subtable">
                    <tr>
                        <td>Admin</td>
                        <td>{{ $user->filter(fn($item) => in_array($item->peran->kode_peran, [App\Enums\Peran\PeranEnums::ADMIN->value]))->count() }}
                        </td>
                    </tr>
                    <tr>
                        <td>Sarpras</td>
                        <td>{{ $user->filter(fn($item) => in_array($item->peran->kode_peran, [App\Enums\Peran\PeranEnums::SARANA_PRASARANA->value]))->count() }}
                        </td>
                    </tr>
                    <tr>
                        <td>Teknisi</td>
                        <td>{{ $user->filter(fn($item) => in_array($item->peran->kode_peran, [App\Enums\Peran\PeranEnums::TEKNISI->value]))->count() }}
                        </td>
                    </tr>
                    <tr>
                        <td>Mahasiswa</td>
                        <td>{{ $user->filter(fn($item) => in_array($item->peran->kode_peran, [App\Enums\Peran\PeranEnums::MAHASISWA->value]))->count() }}
                        </td>
                    </tr>
                    <tr>
                        <td>Dosen</td>
                        <td>{{ $user->filter(fn($item) => in_array($item->peran->kode_peran, [App\Enums\Peran\PeranEnums::DOSEN->value]))->count() }}
                        </td>
                    </tr>
                    <tr>
                        <td>Tenaga Pendidik</td>
                        <td>{{ $user->filter(fn($item) => in_array($item->peran->kode_peran, [App\Enums\Peran\PeranEnums::TENAGA_KEPENDIDIKAN->value]))->count() }}
                        </td>
                    </tr>
                    <tr class="total-row">
                        <td>Total</td>
                        <td>{{ $user->count() }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-4">
                <h5>Data Laporan</h5>
                <table class="print-subtable">
                    <tr>
                        <td>Laporan Baru</td>
                        <td>{{ $laporan->filter(fn($item) => in_array($item->status->value, [App\Enums\Status\StatusLaporanPerbaikan::BARU->value]))->count() }}
                        </td>
                    </tr>
                    <tr>
                        <td>Laporan Diproses</td>
                        <td>{{ $laporan->filter(fn($item) => in_array($item->status->value, [App\Enums\Status\StatusLaporanPerbaikan::DIAJUKAN->value]))->count() }}
                        </td>
                    </tr>
                    <tr>
                        <td>Laporan Diverifikasi</td>
                        <td>{{ $laporan->filter(fn($item) => in_array($item->status->value, [App\Enums\Status\StatusLaporanPerbaikan::VERIFIKASI->value]))->count() }}
                        </td>
                    </tr>
                    <tr>
                        <td>Laporan Selesai</td>
                        <td>{{ $laporan->filter(fn($item) => in_array($item->status->value, [App\Enums\Status\StatusLaporanPerbaikan::SELESAI->value]))->count() }}
                        </td>
                    </tr>
                    <tr class="total-row">
                        <td>Total</td>
                        <td>{{ $laporan->count() }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-4">
                <h5>Data Fasilitas</h5>
                <table class="print-subtable">
                    <tr>
                        <td>Fasilitas Umum</td>
                        <td>{{ $fasilitas->filter(fn($item) => in_array($item->kategori->kode, ['FSU']))->count() }}</td>
                    </tr>
                    <tr>
                        <td>Fasilitas Penunjang</td>
                        <td>{{ $fasilitas->filter(fn($item) => in_array($item->kategori->kode, ['FSP']))->count() }}</td>
                    </tr>
                    <tr>
                        <td>Fasilitas Inti</td>
                        <td>{{ $fasilitas->filter(fn($item) => in_array($item->kategori->kode, ['FSI']))->count() }}</td>
                    </tr>
                    <tr class="total-row">
                        <td>Total</td>
                        <td>{{ $fasilitas->count() }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="print-section">
        <h4 class="section-title">Statistik Laporan Per Periode</h4>
        <table class="print-table">
            <thead>
                <tr>
                    <th>Periode</th>
                    <th>Total</th>
                    <th>Baru</th>
                    <th>Diverifikasi</th>
                    <th>Diajukan</th>
                    <th>Diproses</th>
                    <th>Selesai</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($laporanPerPeriode as $item)
                    <tr>
                        <td>{{ $item['nama_periode'] }}</td>
                        <td>{{ $item['jumlah_laporan'] }}</td>
                        <td>{{ $item['baru'] }}</td>
                        <td>{{ $item['diverifikasi'] }}</td>
                        <td>{{ $item['diajukan'] }}</td>
                        <td>{{ $item['perbaikan'] }}</td>
                        <td>{{ $item['selesai'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="print-footer mt-4">
        <div class="row">
            <div class="col-6 text-left">
                <p>Mengetahui,</p>
                <br><br><br>
                <p>_________________________</p>
                <p>Kepala Sarana Prasarana</p>
            </div>
            <div class="col-6 text-right">
                <p>{{ date('d F Y') }}</p>
                <p>Petugas,</p>
                <br><br><br>
                <p>_________________________</p>
                <p>{{ Auth::user()->nama }}</p>
            </div>
        </div>
    </div>
@endsection

<style>
    body {
        font-family: Arial, sans-serif;
        color: #333;
        font-size: 12px;
    }

    .print-section {
        margin-bottom: 25px;
        page-break-inside: avoid;
    }

    .section-title {
        font-size: 16px;
        border-bottom: 1px solid #ddd;
        padding-bottom: 5px;
        margin-bottom: 10px;
    }

    .stat-card {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: center;
        border-radius: 4px;
    }

    .stat-title {
        font-size: 12px;
        color: #666;
    }

    .stat-value {
        font-size: 18px;
        font-weight: bold;
        margin: 5px 0;
    }

    .stat-desc {
        font-size: 10px;
        color: #999;
    }

    .print-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 15px;
    }

    .print-table th,
    .print-table td {
        border: 1px solid #ddd;
        padding: 6px 8px;
        text-align: left;
    }

    .print-table th {
        background-color: #f5f5f5;
        font-weight: bold;
    }

    .print-subtable {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 10px;
    }

    .print-subtable td {
        padding: 4px 8px;
        border-bottom: 1px solid #eee;
    }

    .print-subtable .total-row td {
        font-weight: bold;
        border-top: 1px solid #333;
    }

    .print-footer {
        margin-top: 30px;
        padding-top: 15px;
        border-top: 1px solid #333;
    }

    @media print {
        body {
            padding: 20px;
        }

        .no-print {
            display: none !important;
        }
    }
</style>
