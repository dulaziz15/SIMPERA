<?php

namespace App\Http\Controllers;

use App\Enums\LogActivity\JenisAktivitas;
use App\Services\Interfaces\LogActivityServiceInterface;
use App\Services\Interfaces\NotifikasiServiceInterface;
use App\Services\Interfaces\PelaporanServiceInterface;
use App\Services\Interfaces\SpkServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengajuanController extends Controller
{
    protected $laporanService;
    protected $spkService;
    protected $notifikasiService;
    protected $logService;

    public function __construct(
        PelaporanServiceInterface $laporanService,
        SpkServiceInterface $spkService,
        NotifikasiServiceInterface $notifikasiService,
        LogActivityServiceInterface $logService
    ) {
        $this->laporanService = $laporanService;
        $this->spkService = $spkService;
        $this->notifikasiService = $notifikasiService;
        $this->logService = $logService;
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
        $spk = $this->spkService->hasilSpk();
        // dd($spk);
        // dd($spk);
        $laporan = $this->laporanService->getAll();
        $rekomendasi = $this->laporanService->hasilSpk($spk);
        // dd($rekomendasi);
        $laporanDiajukan = $laporan->filter(function ($item) {
            return $item->status->value === 'diajukan';
        });
        // dd($laporanDiajukan);
        return view('pengajuan.sarpras.index', compact('breadcrumb', 'page', 'activeMenu', 'laporan', 'rekomendasi', 'laporanDiajukan'));
    }

    public function spk()
    {
        $breadcrumb = (object) [
            'title' => 'Pengajuan',
            'list' => ['Home', 'Pengajuan']
        ];

        $page = (object) [
            'title' => 'Daftar Pengajuan yang terdaftar dalam sistem'
        ];

        $activeMenu = 'pengajuan';
        $alternatif = $this->spkService->alternatif();
        $kriteria = $this->spkService->kriteria();
        $normalisasi = $this->spkService->normalisasi();
        $preferensi = $this->spkService->preferensi();
        $persimpanganPreferensi = $this->spkService->persimpanganPreferensi();
        $bobot = $this->spkService->bobot();
        $ranking = $this->spkService->ranking();
        $hasil = $this->spkService->hasil();
        // dd($laporanDiajukan);
        $spk = [
            'alternatif' => $alternatif,
            'kriteria' => $kriteria,
            'normalisasi' => $normalisasi,
            'preferensi' => $preferensi,
            'persimpanganPreferensi' => $persimpanganPreferensi,
            'bobot' => $bobot,
            'ranking' => $ranking,
            'hasil' => $hasil
        ];
        return view('pengajuan.sarpras.spk', compact('breadcrumb', 'page', 'activeMenu', 'spk'));
    }

    public function create($id)
    {
        $laporan = $this->laporanService->show($id);
        return view('pengajuan.component.modal_ajukan', compact('laporan'));
    }

    public function ajukan(Request $request, $idLaporan)
    {
        // dd($request->ajax());
        if ($request->ajax() || $request->wantsJson()) {
            $pengajuan = $this->laporanService->pengajuan($idLaporan);
            if ($pengajuan) {
                $this->notifikasiService->createNotif($idLaporan, 'Pengajuan Laporan Perbaikan', 'Laporan Perbaikan telah diajukan untuk diverifikasi.');
                $this->logService->storeLog(Auth::user()->id_pengguna, JenisAktivitas::PENGAJUAN, 'Melakukan Pengajuan laporan perbaikan', now());
                return response()->json([
                    'status' => true,
                    'message' => 'Laporan Berhasil Diajukan untuk diverifikasi.',
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Laporan Gagal Diajukan untuk diverifikasi.',
                ]);
            }
        }

        return redirect('/pengajuan/');
    }

    public function verifikasi(Request $request, $id)
    {
        // dd($request->ajax());
        if ($request->ajax() || $request->wantsJson()) {
            // dd($request);
            $verifikasi = $this->laporanService->verifikasi($id);
            if ($verifikasi) {
                $this->notifikasiService->createNotif($id, 'Verifikasi Laporan Perbaikan', 'Laporan Perbaikan telah Diverifikasi dan menunggu penugasan untuk proses perbaikan.');
                $this->logService->storeLog(Auth::user()->id_pengguna, JenisAktivitas::VERIFIKASI, 'Melakukan Verifikasi laporan perbaikan yang diajukan', now());
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
