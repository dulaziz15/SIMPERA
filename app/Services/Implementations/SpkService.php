<?php

namespace App\Services\Implementations;

use App\Enums\Status\StatusLaporanPerbaikan;
use App\Models\LaporanPerbaikanModel;
use App\Services\Interfaces\SpkServiceInterface;
use Illuminate\Support\Facades\DB;

class SpkService implements SpkServiceInterface
{
    public function spk()
    {
        // Ambil semua laporan yang statusnya 'baru'
        $laporan = LaporanPerbaikanModel::where('status', StatusLaporanPerbaikan::BARU->value)->get();

        $data = [];


        foreach ($laporan as $item) {
            $idFasilitas = $item->id_fasilitas;

            // 1. Tingkat kerusakan 
            $tingkat_kerusakan = DB::table('m_dukungan_laporan')
                ->join('m_laporan_perbaikan', 'm_dukungan_laporan.id_laporan', '=', 'm_laporan_perbaikan.id_laporan')
                ->where('m_laporan_perbaikan.id_fasilitas', $idFasilitas)
                ->max('tingkat_kerusakan'); // Mengambil Nilai maksimum tingkat kerusakan

            // 2. Fungsi Fasilitas: berdasarkan kategori
            $fungsi = match (strtolower($item->kategori)) {
                'inti' => 3,
                'pendukung' => 2,
                default => 1,
            };

            // 3. Frekuensi Penggunaan
            $frekuensi = $fungsi;

            // 4. Resiko Keselamatan
            $resiko = match (strtolower($item->kategori)) {
                'umum' => 3,
                'pendukung' => 2,
                default => 1,
            };

            // 5. Lokasi Fasilitas
            $lokasi = match (strtolower($item->gedung)) {
                'administratif' => 3,
                'perkuliahan' => 2,
                default => 1,
            };

            // 6. Laporan Kerusakan yang Masuk
            $jumlah_laporan = DB::table('m_laporan_perbaikan')
                ->where('id_fasilitas', $idFasilitas)
                ->count();

            $laporan_bobot = 1;
            if ($jumlah_laporan > 50) $laporan_bobot = 3;
            elseif ($jumlah_laporan >= 20) $laporan_bobot = 2;

            // Menyimpan nilai kriteria
            $data[$idFasilitas] = [
                'nama_fasilitas' => $item->id_laporan,
                'kerusakan' => $tingkat_kerusakan,
                'fungsi' => $fungsi,
                'frekuensi' => $frekuensi,
                'resiko' => $resiko,
                'lokasi' => $lokasi,
                'jumlah_laporan' => $laporan_bobot,
            ];
        }


        // 1. Normalisasi Matrix
        $sumEach = [];
        foreach ($data as $row) {
            foreach ($row as $k => $v) {
                if ($k === 'nama_fasilitas') continue;
                $sumEach[$k] = ($sumEach[$k] ?? 0) + $v;
            }
        }




        $normalized = [];
        foreach ($data as $id => $row) {
            foreach ($row as $k => $v) {
                if ($k === 'nama_fasilitas') continue;
                $normalized[$id][$k] = $v / $sumEach[$k];
            }
        }



        // 2. Rata-Rata Preferensi
        $avgPref = [];
        $countData = count($normalized);
        foreach ($normalized as $row) {
            foreach ($row as $k => $v) {
                $avgPref[$k] = ($avgPref[$k] ?? 0) + $v;
            }
        }
        foreach ($avgPref as $k => $v) {
            $avgPref[$k] = $v / $countData;
        }


        // 3. Penyimpangan Preferensi 
        $deviasi = [];
        foreach ($normalized as $row) {
            foreach ($row as $k => $v) {
                $deviasi[$k] = ($deviasi[$k] ?? 0) + abs($v - $avgPref[$k]);
            }
        }

        // dd($deviasi);
        // dd($normalized);
        foreach ($deviasi as $k => $v) {
            $deviasi[$k] = $v / $countData;
        }

        // 4. Hitung Bobot
        $bobot = [];
        $nilaiPreferensi = [];
        $totalPref = 0;
        foreach ($deviasi as $k => $v) {
            $nilaiPreferensi[$k] = 1 - $v;
            $totalPref += $nilaiPreferensi[$k];
        }
        foreach ($nilaiPreferensi as $k => $v) {
            $bobot[$k] = $v / $totalPref;
        }

        // dd($nilaiPreferensi);

        // 5. WSM: Hitung Skor Akhir
        $skor = [];
        foreach ($data as $id => $row) {
            $total = 0;
            foreach ($row as $k => $v) {
                if ($k === 'nama_fasilitas') continue;
                $total += $v * $bobot[$k];
            }
            $skor[$id] = [
                'nama_fasilitas' => $row['nama_fasilitas'],
                'skor' => round($total, 4)
            ];
        }

        // dd($skor);

        // 6. Ranking
        usort($skor, fn($a, $b) => $b['skor'] <=> $a['skor']);
        foreach ($skor as $i => &$val) {
            $val['ranking'] = $i + 1;
        }


        // dd($skor);

        $hasilAkhir = array_column($skor, 'nama_fasilitas');
        // dd($hasilAkhir);
        return $hasilAkhir;
    }

    public function alternatif()
    {
        return LaporanPerbaikanModel::where('status', StatusLaporanPerbaikan::BARU->value)->get();
    }

    public function kriteria()
    {
        $laporan = $this->alternatif();
        $data = []; // Inisialisasi array data

        foreach ($laporan as $item) {
            $idFasilitas = $item->id_fasilitas;

            // 1. Tingkat kerusakan 
            $tingkat_kerusakan = DB::table('m_dukungan_laporan')
                ->join('m_laporan_perbaikan', 'm_dukungan_laporan.id_laporan', '=', 'm_laporan_perbaikan.id_laporan')
                ->where('m_laporan_perbaikan.id_fasilitas', $idFasilitas)
                ->max('tingkat_kerusakan');

            // 2. Fungsi Fasilitas: berdasarkan kategori
            $fungsi = match (strtolower($item->fasilitas->kategori->kode)) {
                'fsi' => 3,
                'fsp' => 2,
                default => 1,
            };

            // 3. Frekuensi Penggunaan
            $frekuensi = $fungsi; 

            // 4. Resiko Keselamatan
            $resiko = match (strtolower($item->fasilitas->kategori->kode)) {
                'fsi' => 3,
                'fsp' => 2,
                default => 1,
            };

            // 5. Lokasi Fasilitas
            $lokasi = match (strtolower($item->fasilitas->ruangan->gedung->kategori_gedung->kategori_gedung)) {
                'administrasif' => 3,
                'perkuliahan' => 2,
                default => 1,
            };

            // 6. Laporan Kerusakan yang Masuk
            $jumlah_laporan = DB::table('m_dukungan_laporan')
                ->where('id_laporan', $item->id_laporan)
                ->count();

            $laporan_bobot = 1;
            if ($jumlah_laporan >= 3) $laporan_bobot = 3;
            elseif ($jumlah_laporan > 1 ) $laporan_bobot = 2;
            elseif ($jumlah_laporan = 1) $laporan_bobot = 1;

            // Menyimpan nilai kriteria
            $data[$idFasilitas] = [
                'nama_fasilitas' => $item->fasilitas->nama,
                'kerusakan' => $tingkat_kerusakan,
                'fungsi' => $fungsi,
                'frekuensi' => $frekuensi,
                'resiko' => $resiko,
                'lokasi' => $lokasi,
                'jumlah_laporan' => $laporan_bobot,
            ];
        }

        return $data; // Pindahkan return ke luar loop
    }

    public function normalisasi()
    {
        $data = $this->kriteria();
        if (empty($data)) return []; // Tambahkan pengecekan data kosong

        // 1. Normalisasi Matrix
        $sumEach = [];
        foreach ($data as $row) {
            foreach ($row as $k => $v) {
                if ($k === 'nama_fasilitas') continue;
                $sumEach[$k] = ($sumEach[$k] ?? 0) + $v;
            }
        }

        $normalized = [];
        foreach ($data as $id => $row) {
            foreach ($row as $k => $v) {
                if ($k === 'nama_fasilitas') {
                    $normalized[$id][$k] = $v;
                    continue;
                }
                $normalized[$id][$k] = $sumEach[$k] != 0 ? $v / $sumEach[$k] : 0; // Hindari pembagian dengan nol
            }
        }

        return $normalized;
    }

    public function preferensi()
    {
        $normalized = $this->normalisasi();
        if (empty($normalized)) return []; // Tambahkan pengecekan data kosong

        // 2. Rata-Rata Preferensi
        $avgPref = [];
        $countData = count($normalized);

        foreach ($normalized as $row) {
            foreach ($row as $k => $v) {
                if ($k === 'nama_fasilitas') continue;
                $avgPref[$k] = ($avgPref[$k] ?? 0) + $v;
            }
        }

        foreach ($avgPref as $k => $v) {
            $avgPref[$k] = $v / $countData;
        }

        return $avgPref;
    }

    public function persimpanganPreferensi()
    {
        $normalized = $this->normalisasi();
        $avgPref = $this->preferensi();
        if (empty($normalized) || empty($avgPref)) return []; // Tambahkan pengecekan data kosong

        $countData = count($normalized);
        $deviasi = [];

        foreach ($normalized as $row) {
            foreach ($row as $k => $v) {
                if ($k === 'nama_fasilitas') continue;
                $deviasi[$k] = ($deviasi[$k] ?? 0) + abs($v - $avgPref[$k]);
            }
        }

        foreach ($deviasi as $k => $v) {
            $deviasi[$k] = $v / $countData;
        }

        return $deviasi;
    }

    public function bobot()
    {
        $deviasi = $this->persimpanganPreferensi();
        if (empty($deviasi)) return []; // Tambahkan pengecekan data kosong

        // 4. Hitung Bobot
        $bobot = [];
        $nilaiPreferensi = [];
        $totalPref = 0;

        foreach ($deviasi as $k => $v) {
            $nilaiPreferensi[$k] = 1 - $v;
            $totalPref += $nilaiPreferensi[$k];
        }

        foreach ($nilaiPreferensi as $k => $v) {
            $bobot[$k] = $totalPref != 0 ? $v / $totalPref : 0; // Hindari pembagian dengan nol
        }

        return $bobot;
    }

    public function ranking()
    {
        $normalized = $this->normalisasi();
        $bobot = $this->bobot();
        if (empty($normalized) || empty($bobot)) return []; // Tambahkan pengecekan data kosong

        // 5. WSM: Hitung Skor Akhir
        $skor = [];

        foreach ($normalized as $id => $row) {
            $total = 0;
            $nama_fasilitas = $row['nama_fasilitas'] ?? 'Unknown'; // Default value jika tidak ada

            foreach ($row as $k => $v) {
                if ($k === 'nama_fasilitas') continue;
                if (isset($bobot[$k])) { // Pastikan bobot ada
                    $total += $v * $bobot[$k];
                }
            }

            $skor[$id] = [
                'nama_fasilitas' => $nama_fasilitas,
                'skor' => round($total, 4)
            ];
        }

        return $skor;
    }

    public function hasil()
    {
        $skor = $this->ranking();
        if (empty($skor)) return []; // Tambahkan pengecekan data kosong

        // 6. Ranking
        usort($skor, fn($a, $b) => $b['skor'] <=> $a['skor']);

        foreach ($skor as $i => &$val) {
            $val['ranking'] = $i + 1;
        }

        return $skor; // Kembalikan seluruh data skor, bukan hanya nama fasilitas
    }
}
