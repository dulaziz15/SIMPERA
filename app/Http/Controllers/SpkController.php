<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class SPKController extends Controller
{
    public function hitungSPK()
    {
        // Ambil semua laporan yang statusnya 'baru'
        $laporan = DB::table('m_laporan_perbaikan as lp')
            ->join('m_fasilitas as f', 'lp.id_fasilitas', '=', 'f.id_fasilitas')
            ->join('m_kategori_fasilitas as kf', 'f.id_kategori', '=', 'kf.id_kategori')
            ->join('m_ruangan as r', 'f.id_ruangan', '=', 'r.id_ruangan')
            ->join('m_gedung as g', 'r.id_gedung', '=', 'g.id_gedung')
            ->select('lp.id_laporan', 'f.id_fasilitas', 'f.nama as nama_fasilitas', 'kf.nama as kategori',
                     'g.nama as gedung')
            ->where('lp.status', 'baru')
            ->groupBy('lp.id_fasilitas')
            ->get();

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
                'nama_fasilitas' => $item->nama_fasilitas,
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
        foreach ($normalized as $row) {
            foreach ($row as $k => $v) {
                $deviasi[$k] = ($deviasi[$k] ?? 0) + abs($v - $avgPref[$k]);
            }
        }
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

        // 6. Ranking
        usort($skor, fn($a, $b) => $b['skor'] <=> $a['skor']);
        foreach ($skor as $i => &$val) {
            $val['ranking'] = $i + 1;
        }
        
        return response()->json([
            'bobot_kriteria' => $bobot,
            'penyimpangan_preferensi' => $deviasi,
            'hasil_ranking' => $skor,
        ]);
    }
}