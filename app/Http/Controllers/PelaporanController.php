<?php

namespace App\Http\Controllers;

use App\Http\Requests\PelaporanRequest;
use App\Services\Interfaces\FasilitasServiceInterface;
use App\Services\Interfaces\GedungServiceInterface;
use App\Services\Interfaces\PelaporanServiceInterface;
use App\Services\Interfaces\RuanganServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class PelaporanController extends Controller
{
    protected $pelaporanService;
    protected $fasilitasService;
    protected $gedungService;
    protected $ruanganService;
    public function __construct(
        PelaporanServiceInterface $pelaporanService,
        GedungServiceInterface $gedungService,
        FasilitasServiceInterface $fasilitasService,
        RuanganServiceInterface $ruanganService
    ) {
        $this->pelaporanService = $pelaporanService;
        $this->fasilitasService = $fasilitasService;
        $this->gedungService = $gedungService;
        $this->ruanganService = $ruanganService;
    }

    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Laporan Perbaikan',
            'list' => ['Home', 'Laporan Perbaikan']
        ];

        $page = (object) [
            'title' => 'Daftar Laporan Perbaikan yang terdaftar dalam sistem'
        ];

        $activeMenu = 'pelaporan';
        $gedung = $this->gedungService->getAll();
        return view('pelaporan.index', compact('breadcrumb', 'page', 'activeMenu', 'gedung'));
    }

    public function coba()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Laporan Perbaikan',
            'list' => ['Home', 'Laporan Perbaikan']
        ];

        $page = (object) [
            'title' => 'Daftar Laporan Perbaikan yang terdaftar dalam sistem'
        ];

        $activeMenu = 'pelaporan';
        $gedung = $this->gedungService->getAll();
        return view('pelaporan.coba', compact('breadcrumb', 'page', 'activeMenu', 'gedung'));
    }

    public function getAll()
    {
        $pelaporanData = $this->pelaporanService->getAll();
        $pelaporanPeninjauanData = $this->pelaporanService->getAllPeninjauan();
        return DataTables::of($pelaporanData)->make(true);
    }

    public function create()
    {
        $fasilitas = $this->fasilitasService->getAll();
        $gedung = $this->gedungService->getAll();
        $ruangan = $this->ruanganService->getAll();
        return view('pelaporan.create', compact('fasilitas', 'gedung', 'ruangan'));
    }

    public function createLaporanByFasilitas($id_fasilitas)
    {
        $fasilitas = $this->fasilitasService->show($id_fasilitas);
        return view('pelaporan.mahasiswa.create_laporan', compact('fasilitas'));
    }

    public function storePelaporan(PelaporanRequest $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $pelaporan = $this->pelaporanService->storePelaporan($request);
            if ($pelaporan) {
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

    public function show($id)
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Laporan Perbaikan',
            'list' => ['Home', 'Laporan Perbaikan']
        ];

        $page = (object) [
            'title' => 'Daftar Laporan Perbaikan yang terdaftar dalam sistem'
        ];

        $activeMenu = 'pelaporan';
        $laporan = $this->pelaporanService->show($id);
        
        return view('pelaporan.sarpras.show', compact('laporan', 'breadcrumb', 'page', 'activeMenu'));
    }

    public function getLaporan($id)
    {
        $laporan = $this->pelaporanService->getLaporanById($id);
        // dd($laporan);
        return response()->json($laporan);
    }

    public function edit($id)
    {
        $laporan = $this->pelaporanService->show($id);
        $fasilitas = $this->fasilitasService->getAll();
        $gedung = $this->gedungService->getAll();
        $ruangan = $this->ruanganService->getAll();;
        return view('pelaporan.edit', compact('laporan', 'gedung', 'fasilitas', 'ruangan'));
    }

    public function update($id, PelaporanRequest $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $pelaporan = $this->pelaporanService->update($id, $request);
            if ($pelaporan) {
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

    public function confirm($id)
    {
        $pelaporan = $this->pelaporanService->show($id);
        return view('pelaporan.confirm', compact('pelaporan'));
    }

    public function delete($id, Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $pelaporan = $this->pelaporanService->delete($id);
            if ($pelaporan) {
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
 
    public function getRuanganByGedung($id_gedung)
    {
        $ruangan = $this->ruanganService->getByGedung($id_gedung);
        return response()->json($ruangan);
    }

    public function getFasilitasByRuangan($ruangan)
    {
        $fasilitas = $this->fasilitasService->getByRuangan($ruangan);
        return response()->json($fasilitas);
    }

    public function getAllFasilitasByRuangan($id) {
        $fasilitas = $this->fasilitasService->getAllFasilitasByRuangan($id);
        return response()->json($fasilitas);
    }

    public function showFasilitas($id)
    {
        $breadcrumb = (object) [
            'title' => 'Halaman Detail Fasilitas',
            'list' => ['Home', 'Detail Fasilitas']
        ];

        $page = (object) [
            'title' => 'Halaman Detail Fasilitas'
        ];

        $activeMenu = 'pelaporan';
        $fasilitas = $this->fasilitasService->show($id);
        return view('pelaporan.mahasiswa.show', compact('fasilitas', 'breadcrumb', 'page', 'activeMenu'));
    }

}
