<?php

namespace App\Http\Controllers;

use App\Http\Requests\GedungRequest;
use App\Services\Interfaces\GedungServiceInterface;
use App\Services\Interfaces\KategoriGedungServiceInterface;
use App\Services\Interfaces\RuanganServiceInterface;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class GedungController extends Controller
{
    protected $gedungService;
    protected $kategoriGedungService;
    protected $ruanganService;
    public function __construct(
        GedungServiceInterface $gedungService,
        KategoriGedungServiceInterface $kategoriGedungService,
        RuanganServiceInterface $ruanganService
    ) {
        $this->gedungService = $gedungService;
        $this->kategoriGedungService = $kategoriGedungService;
        $this->ruanganService = $ruanganService;
    }
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Gedung',
            'list' => ['Data Master', 'Gedung']
        ];

        $page = (object) [
            'title' => 'Daftar Gedung yang terdaftar dalam sistem'
        ];

        $activeMenu = 'gedung';
        $kategori = $this->kategoriGedungService->getAll();
        $gedung = $this->gedungService->getAll();
        $ruangan = $this->ruanganService->getAll();
        $content = [
            'jumlah_kategori' => $kategori->count(),
            'jumlah_gedung' => $gedung->count()
        ];
        return view('gedung.index', compact('breadcrumb', 'page', 'activeMenu', 'kategori', 'content', 'ruangan', 'gedung'));
    }

    public function getAll(Request $request)
    {
        $gedungService = $this->gedungService;

        if ($request->id_kategori_gedung) {
            $gedungData = $gedungService->getgedungByKategori($request->id_kategori_gedung);
        } else {
            $gedungData = $gedungService->getAll();
        }
        return DataTables::of($gedungData)->make(true);
    }


    public function create()
    {
        $kategori = $this->kategoriGedungService->getAll();
        return view('gedung.create', compact('kategori'));
    }

    public function storeGedung(GedungRequest $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $gedung = $this->gedungService->storeGedung($request);
            if ($gedung) {
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil disimpan.',
                    'redirect' => url('/gedung')
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data Gagal Disimpan.',
                    'redirect' => url('/gedung')
                ]);
            }
        }

        return redirect('/gedung');
    }

    public function show($id)
    {
        $gedung = $this->gedungService->show($id);
        return view('gedung.show', compact('gedung'));
    }

    public function edit($id)
    {
        $gedung = $this->gedungService->show($id);
        $kategori = $this->kategoriGedungService->getAll();
        return view('gedung.edit', compact('gedung', 'kategori'));
    }

    public function update($id, GedungRequest $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $gedung = $this->gedungService->edit($id, $request);
            if ($gedung) {
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil Diupdate.',
                    'redirect' => url('/gedung')
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data Gagal Diupdate.',
                    'redirect' => url('/gedung')
                ]);
            }
        }

        return redirect('/gedung');
    }

    public function confirm($id)
    {
        $gedung = $this->gedungService->show($id);
        return view('gedung.confirm', compact('gedung'));
    }

    public function delete($id, Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $gedung = $this->gedungService->delete($id);
            if ($gedung) {
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
