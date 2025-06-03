<?php

namespace App\Http\Controllers;

use App\Services\Interfaces\PelaporanServiceInterface;
use App\Services\Interfaces\SpkServiceInterface;
use Illuminate\Http\Request;

class PengajuanController extends Controller
{
    protected $laporanService;
    protected $spkService;

    public function __construct(
        PelaporanServiceInterface $laporanService,
        SpkServiceInterface $spkService,
    ) {
        $this->laporanService = $laporanService;
        $this->spkService = $spkService;
    }
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Pengajuan',
            'list' => ['Home', 'Pengajuan']
        ];

        $page = (object) [
            'title' => 'Daftar Pengajuan yang terdaftar dalam sistem'
        ];

        $activeMenu = 'pengajuan';
        $spk = $this->spkService->spk();
        // dd($spk);
        $laporan = $this->laporanService->getAll();
        $rekomendasi = $this->laporanService->hasilSpk($spk);
        // dd($rekomendasi);
        $laporanDiajukan = $laporan->filter(function ($item) {
            return $item->status->value === 'diajukan';
        });
        // dd($laporanDiajukan);
        return view('pengajuan.sarpras.index', compact('breadcrumb', 'page', 'activeMenu', 'laporan', 'rekomendasi', 'laporanDiajukan'));
    }

    public function spk()
    {
        $breadcrumb = (object) [
            'title' => 'Pengajuan',
            'list' => ['Home', 'Pengajuan']
        ];

        $page = (object) [
            'title' => 'Daftar Pengajuan yang terdaftar dalam sistem'
        ];

        $activeMenu = 'pengajuan';
        $alternatif = $this->spkService->alternatif();
        $kriteria = $this->spkService->kriteria();
        $normalisasi = $this->spkService->normalisasi();
        $preferensi = $this->spkService->preferensi();
        $persimpanganPreferensi = $this->spkService->persimpanganPreferensi();
        $bobot = $this->spkService->bobot();
        $ranking = $this->spkService->ranking();
        $hasil = $this->spkService->hasil();
        // dd($laporanDiajukan);
        $spk = [
            'alternatif' => $alternatif,
            'kriteria' => $kriteria,
            'normalisasi' => $normalisasi,
            'preferensi' => $preferensi,
            'persimpanganPreferensi' => $persimpanganPreferensi,
            'bobot' => $bobot,
            'ranking' => $ranking,
            'hasil' => $hasil
        ];
        return view('pengajuan.sarpras.spk', compact('breadcrumb', 'page', 'activeMenu', 'spk'));
    }

    public function ajukan(Request $request, $id)
    {
        // dd($request->ajax());
        if ($request->ajax() || $request->wantsJson()) {
            // dd($request);
            $pengajuan = $this->laporanService->pengajuan($id);
            if ($pengajuan) {
                return response()->json([
                    'status' => true,
                    'message' => 'Laporan Berhasil Diajukan untuk diverifikasi.',
                    'redirect' => url('/pengajuan/')
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Laporan Gagal Diajukan untuk diverifikasi.',
                    'redirect' => url('/pengajuan/')
                ]);
            }
        }

        return redirect('/pengajuan/');
    }

    public function verifikasi(Request $request, $id)
    {
        // dd($request->ajax());
        if ($request->ajax() || $request->wantsJson()) {
            // dd($request);
            $verifikasi = $this->laporanService->verifikasi($id);
            if ($verifikasi) {
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil Diverifikasi.',
                    'redirect' => url('/pelaporan/')
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data Gagal Diverifikasi.',
                    'redirect' => url('/pelaporan/')
                ]);
            }
        }

        return redirect('/pelaporan/');
    }
}
