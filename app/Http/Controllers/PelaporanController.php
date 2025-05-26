<?php

namespace App\Http\Controllers;

use App\Http\Requests\PelaporanRequest;
use App\Services\Interfaces\FasilitasServiceInterface;
use App\Services\Interfaces\PelaporanServiceInterface;
use Illuminate\Http\Request;

class PelaporanController extends Controller
{
    protected $pelaporanService;
    protected $fasilitasService;
    public function __construct(
        PelaporanServiceInterface $pelaporanService,
        FasilitasServiceInterface $fasilitasService
    ){
        $this->pelaporanService = $pelaporanService;
        $this->fasilitasService = $fasilitasService;
    }

    public function index() {
        $breadcrumb = (object) [
            'title' => 'Daftar Laporan Perbaikan',
            'list' => ['Home', 'Laporan Perbaikan']
        ];

        $page = (object) [
            'title' => 'Daftar Laporan Perbaikan yang terdaftar dalam sistem'
        ];

        $activeMenu = 'pelaporan';
        return view('pelaporan.index', compact('breadcrumb', 'page', 'activeMenu'));
    }

    public function create() {
        $fasilitas = $this->fasilitasService->getAll();
        return view('pelaporan.create', compact('fasilitas'));
    }

    public function storePelaporan(PelaporanRequest $request) {
        if ($request->ajax() || $request->wantsJson()) {
            $pelaporan = $this->pelaporanService->storePelaporan($request);
            if($pelaporan) {
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil Disimpan.',
                    'redirect' => url('/pelaporan')
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data Gagal Disimpan.',
                    'redirect' => url('/pelaporan')
                ]);
            }
        }
    }

    public function show($id) {
        $pelaporan = $this->pelaporanService->show($id);
        return view('pelaporan.show', compact('pelaporan'));
    }

    public function edit($id) {
        $pelaporan = $this->pelaporanService->show($id);
        return view('pelaporan.edit', compact('pelaporan'));
    }

    public function update($id, PelaporanRequest $request) {
        if ($request->ajax() || $request->wantsJson()) {
            $pelaporan = $this->pelaporanService->update($id, $request);
            if($pelaporan) {
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil Diupdate.',
                    'redirect' => url('/pelaporan')
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data Gagal Diupdate.',
                    'redirect' => url('/pelaporan')
                ]);
            }
        }

        return redirect('/pelaporan');
    }

    public function confirm($id) {
        $pelaporan = $this->pelaporanService->show($id);
        return view('pelaporan.confirm', compact('pelaporan'));
    }

    public function delete($id, Request $request) {
        if ($request->ajax() || $request->wantsJson()) {
            $pelaporan = $this->pelaporanService->delete($id);
            if($pelaporan) {
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil Dihapus.',
                    'redirect' => url('/pelaporan')
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data Gagal Dihapus.',
                    'redirect' => url('/pelaporan')
                ]);
            }
        }

        return redirect('/pelaporan');
    }
}
