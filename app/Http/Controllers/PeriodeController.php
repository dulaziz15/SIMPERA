<?php

namespace App\Http\Controllers;

use App\Http\Requests\PeriodeRequest;
use App\Services\Interfaces\PeriodeServiceInterface;
use Illuminate\Http\Request;

class PeriodeController extends Controller
{
    protected $periodeServiceInterface;

    public function __construct(PeriodeServiceInterface $periodeServiceInterface) {
        $this->periodeServiceInterface = $periodeServiceInterface;
    }

    public function index() {
        return view('periode.index');
    }

    public function create() {
        return view('periode.create');
    }

    public function storePeriode(PeriodeRequest $request) {

        if ($request->ajax() || $request->wantsJson()) {
            $periode = $this->periodeServiceInterface->storePeriode($request);
            if($periode) {
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil disimpan.',
                    'redirect' => url('/periode')
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data Gagal Disimpan.',
                    'redirect' => url('/periode')
                ]);
            }
        }

        return redirect('/periode');
    }

    public function show($id_periode) {
        return $this->periodeServiceInterface->show($id_periode);
    }

    public function edit($id_periode) {
        $periode = $this->periodeServiceInterface->edit($id_periode);
        return view('periode.edit', compact('periode'));
    }

    public function update($id_periode, PeriodeRequest $request) {

        if ($request->ajax() || $request->wantsJson()) {
            $periode = $this->periodeServiceInterface->update($id_periode,$request);
            if($periode) {
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil Diupdate.',
                    'redirect' => url('/periode')
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data Gagal Diupdate.',
                    'redirect' => url('/periode')
                ]);
            }
        }

        return redirect('/periode');
    }

    public function confirm($id_periode) {
        $periode = $this->periodeServiceInterface->show($id_periode);
        return view('periode.confirm', compact('periode'));
    }

    public function delete($id_periode, Request $request) {
        if ($request->ajax() || $request->wantsJson()) {
            $periode = $this->periodeServiceInterface->delete($id_periode);
            if($periode) {
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil Dihapus.',
                    'redirect' => url('/periode')
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data Gagal Dihapus.',
                    'redirect' => url('/periode')
                ]);
            }
        }

        return redirect('/periode');
    }
}
