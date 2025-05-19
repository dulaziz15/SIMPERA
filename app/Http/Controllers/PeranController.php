<?php

namespace App\Http\Controllers;

use App\Http\Requests\PeranRequest;
use App\Services\Interfaces\PeranServiceInterface;
use Illuminate\Http\Request;

class PeranController extends Controller
{
    protected $peranService;
    public function __construct(PeranServiceInterface $peranService){
        $this->peranService = $peranService;
    }

    public function index() {
        return view('peran.index');
    }

    public function create() {
        return view('peran.create');
    }

    public function show($id) {
        return $this->peranService->show($id);
    }

    public function storePeran(PeranRequest $request) {
        if ($request->ajax() || $request->wantsJson()) {
            $peran = $this->peranService->storePeran($request);
            if($peran) {
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil disimpan.',
                    'redirect' => url('/peran')
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data Gagal Disimpan.',
                    'redirect' => url('/peran')
                ]);
            }
        }

        return redirect('/peran');
    }

    public function edit($id) {
        $peran = $this->peranService->show($id);
        return view('peran.edit', compact('peran'));
    }

    public function update($id, PeranRequest $request) {
        if ($request->ajax() || $request->wantsJson()) {
            $kategori = $this->peranService->edit($id, $request);
            if($kategori) {
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil Diupdate.',
                    'redirect' => url('/peran')
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data Gagal Diupdate.',
                    'redirect' => url('/peran')
                ]);
            }
        }

        return redirect('/peran');
    }

    public function confirm($id) {
        $peran = $this->peranService->show($id);
        return view('peran.confirm', compact('peran'));
    }

    public function delete($id, Request $request) {
        if ($request->ajax() || $request->wantsJson()) {
            $peran = $this->peranService->delete($id);
            if($peran) {
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil Dihapus.',
                    'redirect' => url('/peran')
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data Gagal Dihapus.',
                    'redirect' => url('/peran')
                ]);
            }
        }

        return redirect('/peran');
    }
}
