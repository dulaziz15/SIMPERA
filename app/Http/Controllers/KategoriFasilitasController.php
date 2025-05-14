<?php

namespace App\Http\Controllers;

use App\Http\Requests\KategoriRequest;
use App\Services\Interfaces\KategoriFasilitasServiceInterface;
use Illuminate\Http\Request;

class KategoriFasilitasController extends Controller
{
    protected $kategoriFasilitasService;
    public function __construct(KategoriFasilitasServiceInterface $kategoriFasilitasService){
        $this->kategoriFasilitasService = $kategoriFasilitasService;
    }
    public function index() {
        return view('kategori.index');
    }

    public function create() {
        return view('kategori.create');
    }

    public function storeKategori(KategoriRequest $request) {
        if ($request->ajax() || $request->wantsJson()) {
            $kategori = $this->kategoriFasilitasService->storekategori($request);
            if($kategori) {
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
        return view('kategori.show', compact('kategori'));
    }

    public function edit($id) {
        $kategori = $this->kategoriFasilitasService->show($id);
        return view('kategori.edit', compact('kategori'));
    }

    public function update($id, KategoriRequest $request) {
        if ($request->ajax() || $request->wantsJson()) {
            $kategori = $this->kategoriFasilitasService->edit($id, $request);
            if($kategori) {
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
        return view('kategori.confirm', compact('kategori'));
    }

    public function delete($id, Request $request) {
        if ($request->ajax() || $request->wantsJson()) {
            $kategori = $this->kategoriFasilitasService->delete($id);
            if($kategori) {
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
