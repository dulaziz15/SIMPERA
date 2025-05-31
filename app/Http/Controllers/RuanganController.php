<?php

namespace App\Http\Controllers;

use App\Http\Requests\RuanganRequest;
use App\Services\Interfaces\GedungServiceInterface;
use App\Services\Interfaces\RuanganServiceInterface;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RuanganController extends Controller
{
    protected $ruanganService;
    protected $gedungService;
    public function __construct(
        RuanganServiceInterface $ruanganService,
        GedungServiceInterface $gedungService
    ) {
        $this->ruanganService = $ruanganService;
        $this->gedungService = $gedungService;
    }

    public function getAll(Request $request)
    {
        $ruanganService = $this->ruanganService;

        if ($request->id_gedung) {
            $ruanganData = $ruanganService->getRuanganByGedung($request->id_gedung);
        } else {
            $ruanganData = $ruanganService->getAll();
        }
        return DataTables::of($ruanganData)->make(true);
    }

    public function getByGedung(RuanganRequest $request, $id)
    {
        $ruangan = $this->ruanganService->getByGedung($request);
        return $ruangan;
    }


    public function create()
    {
        $gedung = $this->gedungService->getAll();
        return view('gedung.ruangan.create', compact('gedung'));
    }

    public function store(RuanganRequest $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $ruangan = $this->ruanganService->create($request);
            // return $ruangan;
            if ($ruangan) {
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
        $ruangan = $this->ruanganService->show($id);
        return view('gedung.ruangan.show', compact('ruangan'));
    }

    public function edit($id)
    {
        $ruangan = $this->ruanganService->show($id);
        $gedung = $this->gedungService->getAll();
        return view('gedung.ruangan.edit', compact('ruangan', 'gedung'));
    }

    public function update($id, RuanganRequest $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $ruangan = $this->ruanganService->update($id, $request);
            if ($ruangan) {
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
        $ruangan = $this->ruanganService->show($id);
        return view('gedung.ruangan.confirm', compact('ruangan'));
    }

    public function delete($id, Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $ruangan = $this->ruanganService->delete($id);
            if ($ruangan) {
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
