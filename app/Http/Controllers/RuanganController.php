<?php

namespace App\Http\Controllers;

use App\Services\Interfaces\RuanganServiceInterface;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RuanganController extends Controller
{
    protected $ruanganService;
    public function __construct(RuanganServiceInterface $ruanganService){
        $this->ruanganService = $ruanganService;
    }

    public function getAll(Request $request) {
        $ruanganService = $this->ruanganService;

        if ($request->id_gedung) {
            $ruanganData = $ruanganService->getRuanganByGedung($request->id_gedung);
        } else {
            $ruanganData = $ruanganService->getAll();
        }
        return DataTables::of($ruanganData)->make(true);
    }
}
