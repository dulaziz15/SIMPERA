<?php

namespace App\Http\Controllers;

use App\Enums\Status\StatusLaporanPerbaikan;
use App\Http\Requests\PenugasanRequest;
use App\Services\Interfaces\PelaporanServiceInterface;
use App\Services\Interfaces\PenugasanServiceInterface;
use Illuminate\Http\Request;

class PenugasanController extends Controller
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

    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Penugasan',
            'list' => ['Home', 'Penugasan']
        ];

        $page = (object) [
            'title' => 'Daftar Penugasan yang terdaftar dalam sistem'
        ];

        $activeMenu = 'penugasan';
        $laporan = $this->laporanService->getAll()->filter(function ($item) {
            return !in_array($item->status->value, [
                StatusLaporanPerbaikan::BARU->value,
                StatusLaporanPerbaikan::DIAJUKAN->value
            ]);
        });
        // dd($laporan);
        return view('penugasan.index', compact('breadcrumb', 'page', 'activeMenu', 'laporan'));
    }

    public function show($id)
    {
        $breadcrumb = (object) [
            'title' => 'Penugasan',
            'list' => ['Home', 'Penugasan', 'Detail Laporan']
        ];

        $page = (object) [
            'title' => 'Detail Laporan yang akan ditugaskan'
        ];

        $activeMenu = 'penugasan';
        $laporan = $this->laporanService->show($id);
        return view('penugasan.show', compact('breadcrumb', 'page', 'activeMenu', 'laporan'));
    }

    public function store(PenugasanRequest $request, $idLaporan)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $penugasan = $this->penugasanService->storePenugasan($idLaporan, $request);
            if ($penugasan) {
                return response()->json([
                    'status' => true,
                    'message' => 'Penugasan berhasil disimpan.',
                    'redirect' => url('/penugasan')
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Penugasan Gagal Disimpan.',
                    'redirect' => url('/penugasan')
                ]);
            }
        }

        return redirect('/penugasan');
    }
}
