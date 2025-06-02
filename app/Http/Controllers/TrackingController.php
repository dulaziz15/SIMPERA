<?php

namespace App\Http\Controllers;

use App\Services\Interfaces\FasilitasServiceInterface;
use App\Services\Interfaces\PelaporanServiceInterface;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    protected $pelaporanService;
    protected $fasilitasService;

    public function __construct(
        PelaporanServiceInterface $pelaporanService,
        FasilitasServiceInterface $fasilitasService)
    {
        $this->pelaporanService = $pelaporanService;
        $this->fasilitasService = $fasilitasService;
    }
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Tracking Perbaikan',
            'list' => ['Home', 'Tracking Perbaikan']
        ];

        $page = (object) [
            'title' => 'Halaman untuk melacak status perbaikan'
        ];

        $activeMenu = 'tracking';
        $laporanSaya = $this->pelaporanService->getLaporanByUser(auth()->user()->id_pengguna);
        $laporanDidukung = $this->pelaporanService->getLaporanDidukungByUser(auth()->user()->id_pengguna);
        $laporanSelesai = $this->pelaporanService->getAllLaporanByUser(auth()->user()->id_pengguna);
        return view('pelaporan.mahasiswa.tracking', compact('breadcrumb', 'page', 'activeMenu', 'laporanSaya', 'laporanDidukung', 'laporanSelesai'));
    }

    public function editLaporan($idLaporan)
    {
        $laporan = $this->pelaporanService->show($idLaporan);
        return view('pelaporan.mahasiswa.edit', compact('laporan'));
    }
}
