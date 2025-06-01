<?php

namespace App\Http\Controllers;

use App\Http\Requests\FasilitasRequest;
use App\Services\Interfaces\FasilitasServiceInterface;
use App\Services\Interfaces\GedungServiceInterface;
use App\Services\Interfaces\KategoriFasilitasServiceInterface;
use App\Services\Interfaces\RuanganServiceInterface;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class FasilitasController extends Controller
{
    protected $fasilitasService;
    protected $gedungService;
    protected $ruanganService;
    protected $kategoriFasilitasService;

    public function __construct(
        FasilitasServiceInterface $fasilitasService,
        GedungServiceInterface $gedungService,
        KategoriFasilitasServiceInterface $kategoriFasilitasService,
        RuanganServiceInterface $ruanganService
    ) {
        $this->fasilitasService = $fasilitasService;
        $this->gedungService = $gedungService;
        $this->ruanganService = $ruanganService;
        $this->kategoriFasilitasService = $kategoriFasilitasService;
    }

    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Fasilitas',
            'list' => ['Home', 'Fasilitas']
        ];

        $page = (object) [
            'title' => 'Daftar Fasilitas yang terdaftar dalam sistem'
        ];

        $activeMenu = 'fasilitas';
        return view('fasilitas.index', compact('breadcrumb', 'page', 'activeMenu'));
    }

    public function getAll(Request $request)
    {
        $data = $this->fasilitasService->getAll();

        // if ($request->id_kategori) {
        //     $fasilitasData = $fasilitasService->getFasilitasByKategori($request->id_kategori_gedung);
        // } else {
        //     $fasilitasData = $fasilitasService->getAll();
        // }
        return DataTables::of($data)->make(true);
    }

    public function searchFasilitas(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $fasilitas = $this->fasilitasService->search($request);
            if ($fasilitas) {
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil ditemukan.',
                    'data' => $fasilitas
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan.'
                ]);
            }
        }

        return redirect('/fasilitas');
    }


    public function create()
    {
        $kategori = $this->kategoriFasilitasService->getAll();
        $ruangan = $this->ruanganService->getAll();
        return view('fasilitas.create', compact('ruangan', 'kategori'));
    }

    public function storeFasilitas(FasilitasRequest $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $fasilitas = $this->fasilitasService->storeFasilitas($request);
            if ($fasilitas) {
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

    public function show($id)
    {
        $fasilitas = $this->fasilitasService->show($id);
        // dd($fasilitas);
        return view('fasilitas.show', compact('fasilitas'));
    }

    public function edit($id)
    {
        $fasilitas = $this->fasilitasService->show($id);
        $kategori = $this->kategoriFasilitasService->getAll();
        $ruangan = $this->ruanganService->getAll();
        return view('fasilitas.edit', compact('fasilitas', 'kategori', 'ruangan'));
    }

    public function update($id, FasilitasRequest $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $fasilitas = $this->fasilitasService->update($id, $request);
            if ($fasilitas) {
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

    public function confirm($id)
    {
        $fasilitas = $this->fasilitasService->show($id);
        return view('fasilitas.confirm', compact('fasilitas'));
    }

    public function delete($id, Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $fasilitas = $this->fasilitasService->delete($id);
            if ($fasilitas) {
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
