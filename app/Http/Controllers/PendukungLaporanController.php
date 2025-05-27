<?php

namespace App\Http\Controllers;

use App\Services\Interfaces\PelaporanServiceInterface;
use App\Services\Interfaces\PeranServiceInterface;
use App\Services\Interfaces\UserServiceInterface;
use Illuminate\Http\Request;

class PendukungLaporanController extends Controller
{
    protected $pelaporanService;
    protected $peranService;
    public function __construct(
        PelaporanServiceInterface $pelaporanService,
        PeranServiceInterface $peranService
    ) {
        $this->pelaporanService = $pelaporanService;
        $this->peranService = $peranService;
    }
    public function create($idlaporan)
    {
        $laporan = $this->pelaporanService->show($idlaporan);
        $user = $this->peranService->getAll();
        return view('pelaporan.pendukung.create', compact('laporan', 'user'));
    }
}
