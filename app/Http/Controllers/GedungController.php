<?php

namespace App\Http\Controllers;

use App\Http\Requests\GedungRequest;
use App\Services\Interfaces\GedungServiceInterface;
use Illuminate\Http\Request;

class GedungController extends Controller
{
    protected $gedungService;
    public function __construct(GedungServiceInterface $gedungService){
        $this->gedungService = $gedungService;
    }
    public function index() {
        return view('gedung.index');
    }

    public function create() {
        return view('gedung.create');
    }

    public function storeGedung(GedungRequest $request) {
        if ($request->ajax() || $request->wantsJson()) {
            $gedung = $this->gedungService->storeGedung($request);
            if($gedung) {
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

    public function show($id) {
        $gedung = $this->gedungService->show($id);
        return view('gedung.show', compact('gedung'));
    }

    public function edit($id) {
        $gedung = $this->gedungService->show($id);
        return view('gedung.edit', compact('gedung'));
    }

    public function update($id, GedungRequest $request) {
        if ($request->ajax() || $request->wantsJson()) {
            $gedung = $this->gedungService->edit($id, $request);
            if($gedung) {
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

    public function confirm($id) {
        $gedung = $this->gedungService->show($id);
        return view('gedung.confirm', compact('gedung'));
    }

    public function delete($id, Request $request) {
        if ($request->ajax() || $request->wantsJson()) {
            $gedung = $this->gedungService->delete($id);
            if($gedung) {
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
