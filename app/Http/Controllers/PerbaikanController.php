<?php

namespace App\Http\Controllers;

use App\Enums\Status\StatusLaporanPerbaikan;
use App\Services\Interfaces\PelaporanServiceInterface;
use App\Services\Interfaces\PenugasanServiceInterface;
use Illuminate\Http\Request;

class PerbaikanController extends Controller
{
    protected $penugasanService;
    protected $laporanService;

    public function __construct(
        PenugasanServiceInterface $penugasanService,
        PelaporanServiceInterface $laporanService
    ) {
        $this->penugasanService = $penugasanService;
        $this->laporanService = $laporanService;
    }

    public function index() {
        $breadcrumb = (object) [
            'title' => 'Perbaikan',
            'list' => ['Home', 'Perbaikan']
        ];

        $page = (object) [
            'title' => 'Daftar Perbaikan yang terdaftar dalam sistem'
        ];

        $activeMenu = 'perbaikan';
        // $laporan = $this->laporanService->getAll()->filter(function ($item) {
        //     return !in_array($item->status->value, [
        //         StatusLaporanPerbaikan::BARU->value,
        //         StatusLaporanPerbaikan::DIAJUKAN->value
        //     ]);
        // });
        $penugasan = $this->penugasanService->getPenugasanByTeknisi();
        return view('perbaikan.teknisi.index', compact('breadcrumb', 'page', 'activeMenu', 'penugasan'));
    }
}
