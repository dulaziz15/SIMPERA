<?php

namespace App\Http\Controllers;

use App\Enums\LogActivity\JenisAktivitas;
use App\Http\Requests\KategoriRequest;
use App\Services\Interfaces\KategoriFasilitasServiceInterface;
use App\Services\Interfaces\LogActivityServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class KategoriFasilitasController extends Controller
{
    protected $kategoriFasilitasService;
    protected $logService;
    public function __construct(KategoriFasilitasServiceInterface $kategoriFasilitasService, LogActivityServiceInterface $logService){
        $this->kategoriFasilitasService = $kategoriFasilitasService;
        $this->logService = $logService;
    }
    public function index() {
        return view('kategori.index');
    }

    public function getAll() {
        $kategori = $this->kategoriFasilitasService->getAll();
        if ($kategori && $kategori->count() > 0) {
            return response()->json([
                'status' => true,
                'message' => 'Data berhasil diambil.',
                'data' => $kategori
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
        return view('fasilitas.kategori.create');
    }

    public function storeKategori(KategoriRequest $request) {
        if ($request->ajax() || $request->wantsJson()) {
            $kategori = $this->kategoriFasilitasService->storekategori($request);
            if($kategori) {
                $this->logService->storeLog(Auth::user()->id_pengguna, JenisAktivitas::MENAMBAH, 'Menambah data Katgeori Fasilitas Ke dalam sistem', now());
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil disimpan.',
                    'redirect' => url('/kategori')
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data Gagal Disimpan.',
                    'redirect' => url('/kategori')
                ]);
            }
        }

        return redirect('/kategori');
    }

    public function show($id) {
        $kategori = $this->kategoriFasilitasService->show($id);
        return view('fasilitas.kategori.show', compact('kategori'));
    }

    public function edit($id) {
        $kategori = $this->kategoriFasilitasService->show($id);
        return view('fasilitas.kategori.edit', compact('kategori'));
    }

    public function update($id, KategoriRequest $request) {
        if ($request->ajax() || $request->wantsJson()) {
            $kategori = $this->kategoriFasilitasService->edit($id, $request);
            if($kategori) {
                $this->logService->storeLog(Auth::user()->id_pengguna, JenisAktivitas::MENGUBAH, 'Mengubah data Kategori Fasilitas di dalam sistem', now());
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil Diupdate.',
                    'redirect' => url('/kategori')
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data Gagal Diupdate.',
                    'redirect' => url('/kategori')
                ]);
            }
        }

        return redirect('/kategori');
    }

    public function confirm($id) {
        $kategori = $this->kategoriFasilitasService->show($id);
        return view('fasilitas.kategori.confirm', compact('kategori'));
    }

    public function delete($id, Request $request) {
        if ($request->ajax() || $request->wantsJson()) {
            $kategori = $this->kategoriFasilitasService->delete($id);
            if($kategori) {
                $this->logService->storeLog(Auth::user()->id_pengguna, JenisAktivitas::MENGHAPUS, 'Menghapus data Kategori Fasilitas di dalam sistem', now());
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil Dihapus.',
                    'redirect' => url('/kategori')
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data Gagal Dihapus.',
                    'redirect' => url('/kategori')
                ]);
            }
        }

        return redirect('/kategori');
    }
}
