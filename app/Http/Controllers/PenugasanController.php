<?php

namespace App\Http\Controllers;

use App\Enums\LogActivity\JenisAktivitas;
use App\Enums\Status\StatusLaporanPerbaikan;
use App\Http\Requests\PenugasanRequest;
use App\Services\Interfaces\LogActivityServiceInterface;
use App\Services\Interfaces\NotifikasiServiceInterface;
use App\Services\Interfaces\PelaporanServiceInterface;
use App\Services\Interfaces\PenugasanServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenugasanController extends Controller
{
    protected $penugasanService;
    protected $laporanService;
    protected $notifikasiService;
    protected $logService;

    public function __construct(
        PenugasanServiceInterface $penugasanService,
        PelaporanServiceInterface $laporanService,
        NotifikasiServiceInterface $notifikasiService,
        LogActivityServiceInterface $logService
    ) {
        $this->penugasanService = $penugasanService;
        $this->laporanService = $laporanService;
        $this->notifikasiService = $notifikasiService;
        $this->logService = $logService;
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
            return in_array($item->status->value, [
                StatusLaporanPerbaikan::VERIFIKASI->value,
                StatusLaporanPerbaikan::PERBAIKAN->value
            ]);
        });
        // dd($laporan);
        $penugasan = $this->penugasanService->getPenugasanByTeknisi();
        return view('penugasan.index', compact('breadcrumb', 'page', 'activeMenu', 'laporan', 'penugasan'));
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
                $this->notifikasiService->createNotif($idLaporan, 'Penugasan Perbaikan', 'Laporan Perbaikan telah ditugaskan kepada teknisi untuk proses perbaikan.');
                $this->logService->storeLog(Auth::user()->id_pengguna, JenisAktivitas::PENUGASAN, 'Melakukan Penugasan perbaikan', now());
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

    public function terimaPenugasan(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $terima = $this->penugasanService->terimaPenugasan($id);
            if ($terima) {
                $this->notifikasiService->createNotif($id, 'Penerimaan Penugasan Perbaikan', 'Teknisi telah menerima penugasan perbaikan.');
                $this->logService->storeLog(Auth::user()->id_pengguna, JenisAktivitas::PENUGASAN, 'Menerima penugasan perbaikan', now());
                return response()->json([
                    'status' => true,
                    'message' => 'Penugasan berhasil diterima.',
                    'redirect' => url('/penugasan')
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Penugasan Gagal diterima.',
                    'redirect' => url('/penugasan')
                ]);
            }
        }

        return redirect('/penugasan');
    }

    public function selesaiPenugasan(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $terima = $this->penugasanService->selesaiPenugasan($id);
            if ($terima) {
                $this->notifikasiService->createNotif($id, 'Perbaikan Selesai', 'Perbaikan Telah selesai.');
                $this->logService->storeLog(Auth::user()->id_pengguna, JenisAktivitas::SELESAI, 'Menyelesaikan Tugas Perbaikan', now());
                return response()->json([
                    'status' => true,
                    'message' => 'Penugasan telah diselesaikan.',
                    'redirect' => url('/penugasan')
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Penugasan gagal diselesaikan.',
                    'redirect' => url('/penugasan')
                ]);
            }
        }

        return redirect('/penugasan');
    }
}
