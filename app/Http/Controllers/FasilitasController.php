<?php

namespace App\Http\Controllers;

use App\Http\Requests\FasilitasRequest;
use App\Services\Interfaces\FasilitasServiceInterface;
use App\Services\Interfaces\GedungServiceInterface;
use App\Services\Interfaces\KategoriFasilitasServiceInterface;
use Illuminate\Http\Request;

class FasilitasController extends Controller
{
    protected $fasilitasService;
    protected $gedungService;
    protected $kategoriFasilitasService;

    public function __construct(
        FasilitasServiceInterface $fasilitasService, 
        GedungServiceInterface $gedungService,
        KategoriFasilitasServiceInterface $kategoriFasilitasService
    ){
        $this->fasilitasService = $fasilitasService;
        $this->gedungService = $gedungService;
        $this->kategoriFasilitasService = $kategoriFasilitasService;
    }

    public function index() {
        return view('fasilitas.index');
    }

    public function create() {
        $gedung = $this->gedungService->getAll();
        $kategori = $this->kategoriFasilitasService->getAll();
        return view('fasilitas.create', compact('gedung', 'kategori'));
    }

    public function storeFasilitas(FasilitasRequest $request) {
        if ($request->ajax() || $request->wantsJson()) {
            $fasilitas = $this->fasilitasService->storeFasilitas($request);
            if($fasilitas) {
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil disimpan.',
                    'redirect' => url('/fasilitas')
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data Gagal Disimpan.',
                    'redirect' => url('/fasilitas')
                ]);
            }
        }

        return redirect('/fasilitas');
    }

    public function show($id) {
        $fasilitas = $this->fasilitasService->show($id);
        return view('fasilitas.show', compact('fasilitas'));
    }

    public function edit($id) {
        $fasilitas = $this->fasilitasService->show($id);
        return view('fasilitas.edit', compact('fasilitas'));
    }

    public function update($id, FasilitasRequest $request) {
        if ($request->ajax() || $request->wantsJson()) {
            $fasilitas = $this->fasilitasService->update($id, $request);
            if($fasilitas) {
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil Diupdate.',
                    'redirect' => url('/fasilitas')
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data Gagal Diupdate.',
                    'redirect' => url('/fasilitas')
                ]);
            }
        }

        return redirect('/fasilitas');
    }

    public function confirm($id) {
        $fasilitas = $this->fasilitasService->show($id);
        return view('fasilitas.confirm', compact('fasilitas'));
    }

    public function delete($id, Request $request) {
        if ($request->ajax() || $request->wantsJson()) {
            $fasilitas = $this->fasilitasService->delete($id);
            if($fasilitas) {
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil Dihapus.',
                    'redirect' => url('/fasilitas')
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data Gagal Dihapus.',
                    'redirect' => url('/fasilitas')
                ]);
            }
        }

        return redirect('/fasilitas');
    }
}
