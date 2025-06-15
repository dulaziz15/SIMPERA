<?php

namespace App\Http\Controllers;

use App\Enums\LogActivity\JenisAktivitas;
use App\Http\Requests\KategoriGedungRequest;
use App\Services\Interfaces\KategoriGedungServiceInterface;
use App\Services\Interfaces\LogActivityServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KategoriGedungController extends Controller
{
    protected $kategoriGedungService;
    protected $logService;
    public function __construct(KategoriGedungServiceInterface $kategoriGedungService, LogActivityServiceInterface $logService)
    {
        $this->kategoriGedungService = $kategoriGedungService;
        $this->logService = $logService;
    }

    public function getAll()
    {
        $gedung = $this->kategoriGedungService->getAll();
        if ($gedung && $gedung->count() > 0) {
            return response()->json([
                'status' => true,
                'message' => 'Data berhasil diambil.',
                'data' => $gedung
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
        return view('kategoriGedung.create');
    }

    public function storeKategoriGedung(KategoriGedungRequest $request) {
        if ($request->ajax() || $request->wantsJson()) {
            $kategori_gedung = $this->kategoriGedungService->create($request);
            if ($kategori_gedung) {
                $this->logService->storeLog(Auth::user()->id_pengguna, JenisAktivitas::MENAMBAH, 'Menambah data Kategori Gedung Ke dalam sistem', now());
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil disimpan.'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data Gagal Disimpan.'
                ]);
            }
        }

        return redirect('/gedung');
    }

    public function show($id) {
        $kategori = $this->kategoriGedungService->getById($id);
        return view('kategoriGedung.show', compact('kategori'));
    }

    public function edit($id) {
        $kategori = $this->kategoriGedungService->getById($id);
        return view('kategoriGedung.edit', compact('kategori'));
    }

    public function update($id, KategoriGedungRequest $request) {
        if ($request->ajax() || $request->wantsJson()) {
            $kategori_gedung = $this->kategoriGedungService->update($id, $request);
            if ($kategori_gedung) {
                $this->logService->storeLog(Auth::user()->id_pengguna, JenisAktivitas::MENGUBAH, 'Mengubah data Kategori Gedung dalam dalam sistem', now());
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil Diupadate.'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data Gagal Diupadate.'
                ]);
            }
        }

        return redirect('/gedung');
    }

    public function confirm($id) {
        $kategori = $this->kategoriGedungService->getById($id);
        return view('kategoriGedung.confirm', compact('kategori'));
    }

    public function delete($id, Request $request) {
        if ($request->ajax() || $request->wantsJson()) {
            $kategori_gedung = $this->kategoriGedungService->delete($id);
            if ($kategori_gedung) {
                $this->logService->storeLog(Auth::user()->id_pengguna, JenisAktivitas::MENGHAPUS, 'Menghapus data Kategori Gedung di dalam sistem', now());
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil Dihapus.',
                    'redirect' => url('/gedung')
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data Gagal Dihapus.',
                    'redirect' => url('/gedung')
                ]);
            }
        }

        return redirect('/gedung');
    }
}
