<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanController extends Controller
{
    protected $laporanService;
    protected $userService;
    protected $ruanganService;
    protected $fasilitasService;
    protected $periodeService;
    
    public function __construct(
        \App\Services\Interfaces\PelaporanServiceInterface $laporanService,
        \App\Services\Interfaces\UserServiceInterface $userService,
        \App\Services\Interfaces\RuanganServiceInterface $ruanganService,
        \App\Services\Interfaces\FasilitasServiceInterface $fasilitasService,
        \App\Services\Interfaces\PeriodeServiceInterface $periodeService
    ) {
        $this->laporanService = $laporanService;
        $this->userService = $userService;
        $this->ruanganService = $ruanganService;
        $this->fasilitasService = $fasilitasService;
        $this->periodeService = $periodeService;
    }
    
    public function index(Request $request)
    {
        $breadcrumb = (object) [
            'title' => 'Laporan Keseluruhan',
            'list' => ['Laporan']
        ];

        $page = (object) [
            'title' => 'Data Laporan Keseluruhan Perbaikan Fasilitas'
        ];

        $activeMenu = 'laporan';
        
        // Get filter dates from request or use defaults
        $startDate = $request->input('start_date', now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->input('end_date', now()->format('Y-m-d'));
        
        // Get filtered data
        $laporan = $this->laporanService->filterByDate($startDate, $endDate);
        $biaya = collect($laporan)
            ->where('status', '=', \App\Enums\Status\StatusLaporanPerbaikan::SELESAI)
            ->sum('perkiraan_biaya');
        $totalBiaya = number_format($biaya, 0, ',', '.');
        
        $fasilitasSeringDilaporkan = $this->laporanService->getLaporanSering($startDate, $endDate);
        $perkiraanBiayaPerbaikan = $this->laporanService->getBiayaPerbaikan();
        $laporanPerPeriode = $this->laporanService->getLaporanPerPeriode();
        $periode = $this->periodeService->getNow();
        $user = $this->userService->getAll(); // Users typically aren't date-filtered
        $ruangan = $this->ruanganService->getAll(); // Rooms typically aren't date-filtered
        $fasilitas = $this->fasilitasService->getAll(); // Facilities typically aren't date-filtered
        
        return view('laporan.index', compact(
            'breadcrumb', 
            'page', 
            'activeMenu', 
            'laporan', 
            'user', 
            'ruangan', 
            'fasilitas', 
            'fasilitasSeringDilaporkan', 
            'totalBiaya',
            'startDate',
            'endDate',
            'periode',
            'perkiraanBiayaPerbaikan',
            'laporanPerPeriode'
        ));
    }
}