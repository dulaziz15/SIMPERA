@extends('layout.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <h5>Alternatif</h5>
                    @foreach ($spk['alternatif'] as $alternatif)
                        <li>{{ $alternatif->id_laporan }}</li>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <h5>kriteria</h5>
                    <table border="2" class="table">
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
                    <table border="2" class="table">
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
                    <table border="2" class="table">
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
                    <table border="2" class="table">
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
                    <table border="2" class="table">
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
                    <table border="2" class="table">
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
                    <table border="2" class="table">
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
