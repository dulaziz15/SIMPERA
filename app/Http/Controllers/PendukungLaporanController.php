<?php

namespace App\Http\Controllers;

use App\Services\Implementations\PendukungService;
use App\Services\Interfaces\PelaporanServiceInterface;
use App\Services\Interfaces\PendukungServiceInterface;
use App\Services\Interfaces\PeranServiceInterface;
use App\Services\Interfaces\UserServiceInterface;
use Illuminate\Http\Request;

class PendukungLaporanController extends Controller
{
    protected $pelaporanService;
    protected $peranService;
    protected $pendukungService;
    public function __construct(
        PelaporanServiceInterface $pelaporanService,
        PeranServiceInterface $peranService,
        PendukungServiceInterface $pendukungService
    ) {
        $this->pelaporanService = $pelaporanService;
        $this->peranService = $peranService;
        $this->pendukungService = $pendukungService;
    }
    public function create($idlaporan)
    {
        $laporan = $this->pelaporanService->show($idlaporan);
        $user = $this->peranService->getAll();
        return view('pelaporan.pendukung.create', compact('laporan', 'user'));
    }

    public function createDukungan($idFasilitas)
    {
        $laporan = $this->pelaporanService->getLaporanByFasilitas($idFasilitas);
        $user = $this->peranService->getAll();
        // dd($laporan);
        return view('pelaporan.mahasiswa.dukung_laporan', compact('laporan', 'user'));
    }

    public function store(Request $request, $idlaporan)
    {
        // dd($request->ajax());
        if ($request->ajax() || $request->wantsJson()) {
            // dd($request);
            $pendukung = $this->pendukungService->create($idlaporan, $request);
            if ($pendukung) {
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil disimpan.',
                    'redirect' => url('/pelaporan/' . $idlaporan)
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data Gagal Disimpan.',
                    'redirect' => url('/pelaporan/' . $idlaporan)
                ]);
            }
        }

        return redirect('/pelaporan/' . $idlaporan);
    }

    public function delete($idlaporan, $idPendukung, Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $pendukung = $this->pendukungService->delete($idlaporan, $idPendukung);
            if ($pendukung) {
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil Dihapus.',
                    'redirect' => url('pelaporan/' . $idlaporan . '/show')
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data Gagal Dihapus.',
                    'redirect' => url('pelaporan/' . $idlaporan . '/show') 
                ]);
            }
        }

        return redirect('pelaporan/' . $idlaporan . '/show');
    }
}
