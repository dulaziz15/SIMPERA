<?php

namespace App\Http\Controllers;

use App\Services\Interfaces\PelaporanServiceInterface;
use Illuminate\Http\Request;

class PengajuanController extends Controller
{
    protected $laporanService;

    public function __construct(PelaporanServiceInterface $laporanService)
    {
        $this->laporanService = $laporanService;
    }
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Pengajuan',
            'list' => ['Home', 'Pengajuan']
        ];

        $page = (object) [
            'title' => 'Daftar Pengajuan yang terdaftar dalam sistem'
        ];

        $activeMenu = 'pengajuan';
        $laporan = $this->laporanService->getAll();
        $rekomendasi = $this->laporanService->show([])->filter(function ($item) {
            return $item->status->value === 'baru';
        });
        $laporanDiajukan = $laporan->filter(function ($item) {
            return $item->status->value === 'diajukan';
        });
        // dd($laporanDiajukan);
        return view('pengajuan.sarpras.index', compact('breadcrumb', 'page', 'activeMenu', 'laporan', 'rekomendasi', 'laporanDiajukan'));
    }

    public function ajukan(Request $request, $id) {
        // dd($request->ajax());
        if ($request->ajax() || $request->wantsJson()) {
            // dd($request);
            $pengajuan = $this->laporanService->pengajuan($id);
            if ($pengajuan) {
                return response()->json([
                    'status' => true,
                    'message' => 'Laporan Berhasil Diajukan untuk diverifikasi.',
                    'redirect' => url('/pengajuan/')
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Laporan Gagal Diajukan untuk diverifikasi.',
                    'redirect' => url('/pengajuan/')
                ]);
            }
        }

        return redirect('/pengajuan/');
    }

    public function verifikasi(Request $request, $id) {
        // dd($request->ajax());
        if ($request->ajax() || $request->wantsJson()) {
            // dd($request);
            $verifikasi = $this->laporanService->verifikasi($id);
            if ($verifikasi) {
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil Diverifikasi.',
                    'redirect' => url('/pelaporan/')
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data Gagal Diverifikasi.',
                    'redirect' => url('/pelaporan/')
                ]);
            }
        }

        return redirect('/pelaporan/');
    }
}
