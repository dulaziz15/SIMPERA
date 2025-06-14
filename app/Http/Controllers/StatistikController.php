<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StatistikController extends Controller
{
    protected $laporanService;
    protected $userService;
    protected $ruanganService;
    protected $fasilitasService;
    public function __construct(
        \App\Services\Interfaces\PelaporanServiceInterface $laporanService,
        \App\Services\Interfaces\UserServiceInterface $userService,
        \App\Services\Interfaces\RuanganServiceInterface $ruanganService,
        \App\Services\Interfaces\FasilitasServiceInterface $fasilitasService
    ) {
        $this->laporanService = $laporanService;
        $this->userService = $userService;
        $this->ruanganService = $ruanganService;
        $this->fasilitasService = $fasilitasService;
    }
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Statistik Periode Saat Ini',
            'list' => ['Statistik', 'Laporan']
        ];

        $page = (object) [
            'title' => 'Data Statistik Laporan Perbaikan'
        ];

        $activeMenu = 'statistik';
        $laporan = $this->laporanService->all();
        $laporanThisPeriode = $this->laporanService->getByPeriode();
        $biaya = collect($laporanThisPeriode)
            ->where('status', '=', \App\Enums\Status\StatusLaporanPerbaikan::SELESAI)
            ->sum('perkiraan_biaya');
        $totalBiaya = number_format($biaya, 0, ',', '.');
        // dd($totalBiaya);
        $fasilitasSeringDilaporkan = $this->laporanService->getLaporanSeringThisPeriode();
        $perkiraanBiayaPerbaikan = $this->laporanService->getBiayaPerbaikan();
        $user = $this->userService->getAll();
        $ruangan = $this->ruanganService->getAll();
        $fasilitas = $this->fasilitasService->getAll();
        return view('statistik.index', compact(
            'breadcrumb', 
            'page', 
            'activeMenu', 
            'laporan', 
            'user', 
            'ruangan', 
            'fasilitas', 
            'laporanThisPeriode', 
            'fasilitasSeringDilaporkan', 
            'totalBiaya',
            'perkiraanBiayaPerbaikan'));
    }
}
