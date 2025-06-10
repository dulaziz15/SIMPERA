@extends('layout.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <table border="0" class="table table-responsive table-striped table-bordered">
                    <thead>
                        <th class="">Alternatif</th>
                        <th>Id Laporan</th>
                        <th>Nama Fasilitas</th>
                        <th>kategori Fasilitas</th>
                        <th>Ruangan</th>
                        <th>Gedung</th>
                        <th>Jumlah Dukungan</th>
                    </thead>
                    <tbody>
                        @foreach ($spk['alternatif'] as $i => $item)
                            <tr>
                                <td>Alternatif {{ $i + 1 }}</td>
                                <td>{{ $item->id_laporan }}</td>
                                <td>{{ $item->fasilitas->nama }}</td>
                                <td>{{ $item->fasilitas->kategori->nama }}</td>
                                <td>{{ $item->fasilitas->ruangan->nama }}</td>
                                <td>{{ $item->fasilitas->ruangan->gedung->nama }}</td>
                                <td>{{ $item->pendukung->count() }}</td>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <h5>kriteria</h5>
                    <table border="0" class="table table-responsive table-striped table-bordered">
                        <thead>
                            <th>Nama Fasilitas</th>
                            <th>Kerusakan</th>
                            <th>Fungsi</th>
                            <th>Frequensi</th>
                            <th>Resiko</th>
                            <th>Lokasi</th>
                            <th>Jumlah Laporan</th>
                        </thead>
                        <tbody>

                            @foreach ($spk['kriteria'] as $kriteria)
                                <tr>
                                    <td>{{ $kriteria['nama_fasilitas'] }}</td>
                                    <td>{{ $kriteria['kerusakan'] }}</td>
                                    <td>{{ $kriteria['fungsi'] }}</td>
                                    <td>{{ $kriteria['frekuensi'] }}</td>
                                    <td>{{ $kriteria['resiko'] }}</td>
                                    <td>{{ $kriteria['lokasi'] }}</td>
                                    <td>{{ $kriteria['jumlah_laporan'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <h5>Normalisasi</h5>
                    <table border="0" class="table table-responsive table-striped table-bordered">
                        <thead>
                            <th>Nama Fasilitas</th>
                            <th>Kerusakan</th>
                            <th>Fungsi</th>
                            <th>Frequensi</th>
                            <th>Resiko</th>
                            <th>Lokasi</th>
                            <th>Jumlah Laporan</th>
                        </thead>
                        <tbody>

                            @foreach ($spk['normalisasi'] as $normalisasi)
                                <tr>
                                    <td>{{ $normalisasi['nama_fasilitas'] }}</td>
                                    <td>{{ $normalisasi['kerusakan'] }}</td>
                                    <td>{{ $normalisasi['fungsi'] }}</td>
                                    <td>{{ $normalisasi['frekuensi'] }}</td>
                                    <td>{{ $normalisasi['resiko'] }}</td>
                                    <td>{{ $normalisasi['lokasi'] }}</td>
                                    <td>{{ $normalisasi['jumlah_laporan'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <h5>Preferensi</h5>
                    <table border="0" class="table table-responsive table-striped table-bordered">
                        <thead>
                            <th>Kerusakan</th>
                            <th>Fungsi</th>
                            <th>Frequensi</th>
                            <th>Resiko</th>
                            <th>Lokasi</th>
                            <th>Jumlah Laporan</th>
                        </thead>
                        <tbody>
                            <tr>
                                @foreach ($spk['preferensi'] as $preferensi)
                                    <td>{{ $preferensi }}</td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <h5>Persimpangan Preferensi</h5>
                    <table border="0" class="table table-responsive table-striped table-bordered">
                        <thead>
                            <th>Kerusakan</th>
                            <th>Fungsi</th>
                            <th>Frequensi</th>
                            <th>Resiko</th>
                            <th>Lokasi</th>
                            <th>Jumlah Laporan</th>
                        </thead>
                        <tbody>
                            <tr>
                                @foreach ($spk['persimpanganPreferensi'] as $persimpanganPreferensi)
                                    <td>{{ $persimpanganPreferensi }}</td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <h5>Bobot</h5>
                    <table border="0" class="table table-responsive table-striped table-bordered">
                        <thead>
                            <th>Kerusakan</th>
                            <th>Fungsi</th>
                            <th>Frequensi</th>
                            <th>Resiko</th>
                            <th>Lokasi</th>
                            <th>Jumlah Laporan</th>
                        </thead>
                        <tbody>
                            <tr>
                                @foreach ($spk['bobot'] as $bobot)
                                    <td>{{ $bobot }}</td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <h5>Skor</h5>
                    <table border="0" class="table table-responsive table-striped table-bordered">
                        <thead>
                            <th>Nama Fasilitas</th>
                            <th>Skor</th>
                        </thead>
                        <tbody>

                            @foreach ($spk['ranking'] as $ranking)
                                <tr>
                                    <td>{{ $ranking['nama_fasilitas'] }}</td>
                                    <td>{{ $ranking['skor'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <h5>Ranking</h5>
                    <table border="0" class="table table-responsive table-striped table-bordered">
                        <thead>
                            <th>Nama Fasilitas</th>
                            <th>Skor</th>
                            <th>Ranking</th>
                        </thead>
                        <tbody>

                            @foreach ($spk['hasil'] as $hasil)
                                <tr>
                                    <td>{{ $hasil['nama_fasilitas'] }}</td>
                                    <td>{{ $hasil['skor'] }}</td>
                                    <td>{{ $hasil['ranking'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
