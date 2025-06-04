<?php

namespace App\Http\Controllers;

use App\Services\Interfaces\FasilitasServiceInterface;
use App\Services\Interfaces\PelaporanServiceInterface;
use App\Services\Interfaces\RuanganServiceInterface;
use App\Services\Interfaces\UserServiceInterface;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $laporanService;
    protected $userService;
    protected $ruanganService;
    protected $fasilitasService;

    public function __construct(
        PelaporanServiceInterface $pelaporanService,
        UserServiceInterface $userService,
        RuanganServiceInterface $ruanganService,
        FasilitasServiceInterface $fasilitasService
        ){
        $this->laporanService = $pelaporanService;
        $this->userService = $userService;
        $this->ruanganService = $ruanganService;
        $this->fasilitasService = $fasilitasService;
    }
    public function index() {
        $breadcrumb = (object) [
            'title' => 'Dashboard',
            'list' => ['Dashboard', 'Dashboard']
        ];

        $page = (object) [
            'title' => 'Dashboard'
        ];

        $activeMenu = 'dashboard';
        $laporan = $this->laporanService->getAll();
        $user = $this->userService->getAll();
        $ruangan = $this->ruanganService->getAll();
        $fasilitas = $this->fasilitasService->getAll();
        return view('welcome', compact('breadcrumb', 'page', 'activeMenu', 'laporan', 'user', 'ruangan', 'fasilitas'));
    }
}
