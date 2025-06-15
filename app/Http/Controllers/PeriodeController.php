<?php

namespace App\Http\Controllers;

use App\Enums\LogActivity\JenisAktivitas;
use App\Http\Requests\PeriodeRequest;
use App\Services\Interfaces\LogActivityServiceInterface;
use App\Services\Interfaces\PeriodeServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeriodeController extends Controller
{
    protected $periodeServiceInterface;
    protected $logService;

    public function __construct(PeriodeServiceInterface $periodeServiceInterface, LogActivityServiceInterface $logService) {
        $this->periodeServiceInterface = $periodeServiceInterface;
        $this->logService = $logService;
    }

    public function index() {
        $breadcrumb = (object) [
            'title' => 'Periode',
            'list' => ['Home', 'Periode']
        ];

        $page = (object) [
            'title' => 'Daftar Periode yang terdaftar dalam sistem'
        ];

        $activeMenu = 'periode';
        return view('periode.index', compact('breadcrumb', 'page', 'activeMenu'));
    }

    public function getAll() {
        $periode = $this->periodeServiceInterface->getAll();
        if ($periode && $periode->count() > 0) {
            return response()->json([
                'status' => true,
                'message' => 'Data berhasil diambil.',
                'data' => $periode
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan.',
                'data' => []
            ]);
        }
    }

    public function create() {
        return view('periode.create');
    }

    public function storePeriode(PeriodeRequest $request) {

        if ($request->ajax() || $request->wantsJson()) {
            $periode = $this->periodeServiceInterface->storePeriode($request);
            if($periode) {
                $this->logService->storeLog(Auth::user()->id_pengguna, JenisAktivitas::MENAMBAH, 'Menambah data Periode baru', now());
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil disimpan.',
                    'redirect' => url('/periode')
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data Gagal Disimpan.',
                    'redirect' => url('/periode')
                ]);
            }
        }

        return redirect('/periode');
    }

    public function show($id_periode) {
        $periode = $this->periodeServiceInterface->show($id_periode);
        return view('periode.show', compact('periode'));
    }

    public function edit($id_periode) {
        $periode = $this->periodeServiceInterface->edit($id_periode);
        return view('periode.edit', compact('periode'));
    }

    public function update($id_periode, PeriodeRequest $request) {

        if ($request->ajax() || $request->wantsJson()) {
            $periode = $this->periodeServiceInterface->update($id_periode,$request);
            if($periode) {
                $this->logService->storeLog(Auth::user()->id_pengguna, JenisAktivitas::MENGUBAH, 'Mengubah data periode dalam sistem', now());
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil Diupdate.',
                    'redirect' => url('/periode')
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data Gagal Diupdate.',
                    'redirect' => url('/periode')
                ]);
            }
        }

        return redirect('/periode');
    }

    public function confirm($id_periode) {
        $periode = $this->periodeServiceInterface->show($id_periode);
        return view('periode.confirm', compact('periode'));
    }

    public function delete($id_periode, Request $request) {
        if ($request->ajax() || $request->wantsJson()) {
            $periode = $this->periodeServiceInterface->delete($id_periode);
            if($periode) {
                $this->logService->storeLog(Auth::user()->id_pengguna, JenisAktivitas::MENGHAPUS, 'Menghapus data periode dalam sistem', now());
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil Dihapus.',
                    'redirect' => url('/periode')
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data Gagal Dihapus.',
                    'redirect' => url('/periode')
                ]);
            }
        }

        return redirect('/periode');
    }
}
