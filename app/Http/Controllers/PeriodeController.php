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
                    'message' => 'Gambar berhasil diupdate.',
                    'redirect' => url('/periode')
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan.',
                    'redirect' => url('/periode')
                ]);
            }
        }

        return redirect('/periode');
    }
}
